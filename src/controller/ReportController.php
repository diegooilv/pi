<?php

class ReportController extends Controller
{
    private ReportService $reportService;
    private NavigationService $navigationService;
    private AuthService $authService;

    public function __construct()
    {
        $this->reportService = new ReportService();
        $this->navigationService = new NavigationService();
        $this->authService = new AuthService();
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
        $navItems = $this->navigationService->getHeaderItems('report');

        $type = 'post';

        $post = $this->reportService->getPost($id);
        $author = $this->reportService->getAuthor(
            $post['author_id']
        );

        $this->view(
            'report',
            compact('type', 'post', 'author', 'navItems')
        );
    }

    public function form(){
        // fazer o form funcionar
    }
}