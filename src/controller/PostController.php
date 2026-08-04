<?php
class PostController extends Controller
{
    private AuthService $authService;
    private CloudinaryService $cloudinaryService;
    private RecaptchaService $recaptchaService;
    private NavigationService $navigationService;
    public function __construct()
    {
        $this->authService = new AuthService();
        $this->cloudinaryService = new CloudinaryService();
        $this->recaptchaService = new RecaptchaService();
        $this->navigationService = new NavigationService();
    }

    public function index()
    {
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

        $this->view('post', compact('navItems', 'categories'));
    }

}