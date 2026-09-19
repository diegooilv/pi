<?php

class HomeController extends Controller
{
    private NavigationService $navigationService;
    private PostService $postService;

    public function __construct()
    {
        $this->navigationService = new NavigationService();
        $this->postService = new PostService();
    }
    public function index()
    {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 0;

        $postsPerPage = 10;
        $offset = $page * $postsPerPage;

        $postsNumber = $this->postService->getNumberOfPosts();
        $totalPages = (int) ceil($postsNumber / $postsPerPage);

        $navItems = $this->navigationService->getHeaderItems('home');
        $posts = $this->postService->getPosts($postsPerPage, $offset);

        $materials = [];

        $this->view(
            'home',
            compact(
                'navItems',
                'posts',
                'materials',
                'postsNumber',
                'page',
                'totalPages'
            )
        );
    }
}