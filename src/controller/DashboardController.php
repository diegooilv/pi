<?php
class DashboardController extends Controller
{
    private AuthService $authService;
    private NavigationService $navService;
    private PostService $postService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->navService = new NavigationService();
        $this->postService = new PostService();
    }
    public function index()
    {
        $this->authService->requireLogin();
        $navItems = $this->navService->getHeaderItems('dashboard');

        $user = [
            'name' => 'Tommy Shelby',
            'username' => 'tommy',
        ];

        $posts = $this->postService->getPostByAuthorId($_SESSION['auth']['id'], $limit = 100);

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