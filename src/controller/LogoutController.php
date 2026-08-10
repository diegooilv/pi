<?php
class LogoutController extends Controller
{
    private AuthService $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function index()
    {
        $this->authService->logout();
        exit();
    }
}