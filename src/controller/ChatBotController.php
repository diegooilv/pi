<?php

class ChatBotController extends Controller
{
    private GroqService $service;
    private NavigationService $navigationService;

    public function __construct()
    {
        $this->service = new GroqService();
        $this->navigationService = new NavigationService();

    }

    public function index(): void
    {
        $this->view('ia', [
            'navItems' => [
                'Início' => '/',
                'Sobre' => '/about',
                'Entrar' => '/login',
            ],
            'pergunta' => null,
            'resposta' => null,
        ]);
    }

    public function perguntar(): void
    {
        $pergunta = trim($_POST['prompt'] ?? '');

        if (empty($pergunta)) {
            header('Location: /noesis');
            exit;
        }

        $chat = $this->service->chat([
            [
                'role' => 'user',
                'content' => $pergunta
            ]
        ]);
        $resposta = $this->service->getContent($chat);

        $navItems = $this->navigationService->getHeaderItems('home');
        $this->view('ia', [
            'navItems' => $navItems,
            'pergunta' => $pergunta,
            'resposta' => $resposta,
        ]);
    }
}