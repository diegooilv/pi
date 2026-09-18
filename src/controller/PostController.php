<?php
class PostController extends Controller
{
    private AuthService $authService;
    private CloudinaryService $cloudinaryService;
    private RecaptchaService $recaptchaService;
    private NavigationService $navigationService;
    private PostService $postService;
    public function __construct()
    {
        $this->authService = new AuthService();
        $this->cloudinaryService = new CloudinaryService();
        $this->recaptchaService = new RecaptchaService();
        $this->navigationService = new NavigationService();
        $this->postService = new PostService();
    }

    public function create()
    {
        $this->authService->requireLogin();
        $categories = [
            ['id' => 1, 'name' => 'Filosofia Antiga'],
            ['id' => 2, 'name' => 'Filosofia Medieval'],
            ['id' => 3, 'name' => 'Filosofia Moderna'],
            ['id' => 4, 'name' => 'Filosofia Contemporânea'],
            ['id' => 5, 'name' => 'Ética'],
            ['id' => 6, 'name' => 'Lógica'],
            ['id' => 7, 'name' => 'Epistemologia'],
            ['id' => 8, 'name' => 'Estética'],
            ['id' => 9, 'name' => 'Política'],
            ['id' => 10, 'name' => 'Metafísica'],
        ];

        $navItems = $this->navigationService->getHeaderItems('home');

        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];

        unset($_SESSION['errors'], $_SESSION['old']);

        $this->view('createPost', compact('navItems', 'categories', 'errors', 'old'));
    }

    public function createForm()
    {
        CsrfService::check();

        $errors = [];

        if (empty($_POST['title'])) {
            $errors[] = 'O título é obrigatório.';
        }

        if (empty($_POST['category_id'])) {
            $errors[] = 'A categoria é obrigatória.';
        }

        if (empty($_POST['body'])) {
            $errors[] = 'O conteúdo é obrigatório.';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $_POST;
            header('Location: /post/create');
            exit;
        }

        $postService = new PostService();

        $postId = $postService->createPost($_SESSION['auth']['id'], [
            'title' => $_POST['title'],
            'category_id' => $_POST['category_id'],
            'body' => $_POST['body'],
            'reading_time' => $_POST['reading_time'] ?? null,
            'status' => $_POST['status'] ?? 'published',
        ], $_FILES['image'] ?? null);

        header('Location: /post/' . $postId);
        exit;
    }

    public function post($id){
        $post = $this->postService->getPostById($id);
        if (!$post) {
            $this->view('404');
            return;
        }
        $navItems = $this->navigationService->getHeaderItems('home');
        $this->view('showPost', compact('navItems', 'post'));

    }

}