<?php
class DashboardController extends Controller
{
    private AuthService $authService;
    private NavigationService $navService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->navService = new NavigationService();
    }
    public function index()
    {
        $navItems = $this->navService->getHeaderItems('dashboard');

        $user = [
            'name' => 'Tommy Shelby',
            'username' => 'tommy',
        ];

        $posts = [
            [
                'id' => 1,
                'title' => 'Friedrich Nietzsche: vida, obras e pensamento',
                'excerpt' => 'Conheça a trajetória de Nietzsche, suas principais obras e as ideias que transformaram a filosofia ocidental.',
                'date' => '10 de agosto de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 2,
                'title' => 'Deus está morto: o que Nietzsche realmente quis dizer?',
                'excerpt' => 'Entenda o significado filosófico da famosa declaração de Nietzsche e sua relação com a crise dos valores tradicionais.',
                'date' => '3 de agosto de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 3,
                'title' => 'O Übermensch: o conceito de além-do-homem',
                'excerpt' => 'Explore a ideia do Übermensch em Nietzsche e sua relação com a superação de si mesmo e a criação de novos valores.',
                'date' => '28 de julho de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 4,
                'title' => 'Vontade de potência: a força por trás da vida',
                'excerpt' => 'Entenda um dos conceitos centrais do pensamento nietzschiano e suas diferentes interpretações.',
                'date' => '20 de julho de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 5,
                'title' => 'Eterno retorno: você viveria sua vida novamente?',
                'excerpt' => 'Uma análise do conceito de eterno retorno e do desafio de afirmar a própria existência.',
                'date' => '15 de julho de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 6,
                'title' => 'Nietzsche contra a moral tradicional',
                'excerpt' => 'Como Nietzsche questionou a origem dos valores morais e criticou a moralidade herdada do Ocidente.',
                'date' => '8 de julho de 2026',
                'image' => '/assets/images/post.png',
            ],
        ];

        $materials = [
            [
                'id' => 1,
                'title' => 'Resumo — Assim Falou Zaratustra',
                'excerpt' => 'Resumo dos principais conceitos presentes em uma das obras mais conhecidas de Nietzsche.',
                'date' => '9 de agosto de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 2,
                'title' => 'Guia — Genealogia da Moral',
                'excerpt' => 'Material de apoio para compreender a investigação de Nietzsche sobre a origem dos valores morais.',
                'date' => '2 de agosto de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 3,
                'title' => 'Mapa mental — Conceitos de Nietzsche',
                'excerpt' => 'Mapa mental com os principais conceitos: niilismo, vontade de potência, eterno retorno, Übermensch e transvaloração.',
                'date' => '27 de julho de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 4,
                'title' => 'Resumo — Além do Bem e do Mal',
                'excerpt' => 'Material introdutório sobre a crítica de Nietzsche à moral, à verdade e aos filósofos dogmáticos.',
                'date' => '19 de julho de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 5,
                'title' => 'Ficha de leitura — O Anticristo',
                'excerpt' => 'Principais argumentos e críticas presentes na obra, com contexto para compreender sua filosofia.',
                'date' => '12 de julho de 2026',
                'image' => '/assets/images/post.png',
            ],
            [
                'id' => 6,
                'title' => 'Material extra — Linha do tempo de Nietzsche',
                'excerpt' => 'Linha do tempo com os principais acontecimentos da vida de Nietzsche e a publicação de suas obras.',
                'date' => '5 de julho de 2026',
                'image' => '/assets/images/post.png',
            ],
        ];

        $this->view('dashboard', compact('navItems', 'user', 'posts', 'materials'));
    }
}