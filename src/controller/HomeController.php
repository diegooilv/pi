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
        $navItems = $this->navigationService->getHeaderItems('home');
        $posts = $this->postService->getPosts(10);
        $materials = [];
        $this->view('home', compact('navItems', 'posts', 'materials'));
    }
}