<?php
class GroqService
{
    private string $apiKey;
    private string $model;
    private string $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    private RedisService $redisService;

    private array $maximun = [
        "rpm" => 30,
        "rpd" => 1000,
        "tpm" => 12000,
        "tpd" => 100000
    ];
    public function __construct(string $model = 'openai/gpt-oss-120b')
    {
        $this->apiKey = trim(require __DIR__ . '/../config/groq.php');
        $this->model = $model;
        $this->redisService = new RedisService();
    }

    public function chat($messages)
    {
        $rpm = $this->redisService->get('rpm');
        $rpd = $this->redisService->get('rpd');
        $tpm = $this->redisService->get('tpm');
        $tpd = $this->redisService->get('tpd');

        if (
            $rpm >= $this->maximun['rpm'] ||
            $rpd >= $this->maximun['rpd'] ||
            $tpm >= $this->maximun['tpm'] ||
            $tpd >= $this->maximun['tpd']
        ) {
            return "<p class='noesis-ia'>Estou descansando agora... tente novamente em breve!</p>";
        }
        // array_unshift() insere o system prompt no início do array de mensagens
        array_unshift($messages, [
            'role' => 'system',
            'content' => "
Você é Noesis, assistente filosófica.
REGRAS DE CONTEÚDO:
- Responda apenas sobre temas de filosofia.
- Se a pergunta não for filosófica, informe educadamente que seu foco é filosofia e sugira um tema relacionado.
- Se perguntarem sobre o projeto, responda: \"Leia a página \\\"Sobre\\\".
- Escreva em português natural, claro e sem erros gramaticais.
FORMATAÇÃO (regras rígidas):
- Use APENAS estas tags, exatamente como abaixo:
<p class='noesis-ia'>Texto</p>
<strong class='noesis-ia'>Texto</strong>
<em class='noesis-ia'>Texto</em>
<ul class='noesis-ia'><li class='noesis-ia'>Item</li></ul>
<blockquote class='noesis-ia'><p class='noesis-ia'>Citação</p></blockquote>
<br class='noesis-ia'>
- Toda tag deve ter class='noesis-ia', sem exceção.
- Nunca use markdown (nada de **, -, #, etc.).
- Nunca use outras tags além das listadas acima (nada de <h1>, <div>, <span>, <ol>, <table>, etc.).
- Nunca use listas aninhadas (uma <ul> dentro de outra <li>, ou sublistas de qualquer tipo). Cada <ul> deve conter apenas <li> diretos, sem hierarquia.
- Nunca use estilos inline (style=) ou atributos além de class='noesis-ia'.
ESTILO DE RESPOSTA:
- Prefira texto corrido, em 2 a 5 parágrafos.
- Use listas (<ul><li>) e citações (<blockquote>) apenas quando forem realmente necessárias para a clareza — não como padrão.
- Tom: claro, acessível e reflexivo.
                        "
        ]);
        // Inicializa uma sessão cURL para o endpoint da Groq
        $ch = curl_init($this->apiUrl);

        curl_setopt_array($ch, [
            // Retorna a resposta como string em vez de imprimir diretamente
            CURLOPT_RETURNTRANSFER => true,
            // Define o método como POST
            CURLOPT_POST => true,
            // Cabeçalhos HTTP: tipo de conteúdo e autenticação via Bearer token
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->apiKey
            ],
            // Corpo da requisição serializado em JSON
            CURLOPT_POSTFIELDS => json_encode([
                'model' => $this->model,
                'messages' => $messages
            ])
        ]);

        $response = curl_exec($ch);

        // curl_errno() retorna um código de erro caso a requisição tenha falhado
        if (curl_errno($ch)) {
            return null;
        }

        // Decodifica o JSON retornado pela API para array PHP
        // $this->redisService->reqGroq($response['usage']['total_tokens']);
        $result = json_decode($response, true);
        $this->redisService->reqGroq($result['usage']['total_tokens']);
        return $result;
    }

    public function getContent($result)
    {
        return $result['choices'][0]['message']['content'] ?? null;
    }
}