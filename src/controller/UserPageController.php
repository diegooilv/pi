<?php
class UserPageController extends Controller
{
    private UserService $userService;
    private NavigationService $navigationService;


    public function __construct()
    {
        $this->userService = new UserService();
        $this->navigationService = new NavigationService();
    }
    public function index($username)
    {
        $user = $this->userService->getUserByUsername($username);
        $navItems = $this->navigationService->getHeaderItems('home');

        if (!$user) {
            http_response_code(404);
            $this->view('404', compact('navItems'));
            return;
        }

        unset($user['password_hash']);
        $this->view('user', compact('user', 'navItems'));
    }
}
