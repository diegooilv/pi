<?php
class ProfileController extends Controller
{
    private AuthService $authService;
    private NavigationService $navigationService;
    private UserService $userService;
    public function __construct()
    {
        $this->authService = new AuthService();
        $this->navigationService = new NavigationService();
        $this->userService = new UserService();
    }
    public function index()
    {
        $this->authService->requireLogin();
        $navItems = $this->navigationService->getHeaderItems('home');
        $id =  $_SESSION['auth']['id'] ?? null;
        $user = $this->userService->getUserById($id);

        if (!$user) {
            $this->view('404', compact('navItems'));
            return;
        }
        unset($user['password_hash']);
        $this->view('profile', compact('navItems', 'user'));
    }
}