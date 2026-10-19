<?php

class ReportController extends Controller
{
    private ReportService $reportService;
    private NavigationService $navigationService;
    private AuthService $authService;
    private UserService $userService;

    public function __construct()
    {
        $this->reportService = new ReportService();
        $this->navigationService = new NavigationService();
        $this->authService = new AuthService();
        $this->userService = new UserService();
    }

    // $material, $author
    public function material($id)
    {
       //
    }

    // $post, $author
    public function post($id)
    {
        $this->authService->requireLogin();
        $navItems = $this->navigationService->getHeaderItems('home');

        $type = 'post';

        $post = $this->reportService->getPost($id);
        if (!$post) {
            http_response_code(404);
            $this->view('404', compact('navItems'));
            return;
        }

        $author = $this->reportService->getAuthor(
            $post['author_id']
        );

        $this->view(
            'report',
            compact('type', 'post', 'author', 'navItems')
        );
    }

    public function user($username)
    {
        $this->authService->requireLogin();
        $navItems = $this->navigationService->getHeaderItems('home');

        $type = 'user';
        $user = $this->userService->getUserByUsername($username);
        if (!$user) {
            http_response_code(404);
            $this->view('404', compact('navItems'));
            return;
        }

        $this->view(
            'report',
            compact('type', 'user', 'navItems')
        );
    }
    public function form(){
        // fazer o form funcionar
    }
}
