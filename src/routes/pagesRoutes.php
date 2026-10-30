<?php

$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$router->get('/report/material/{id}', [ReportController::class, 'material']);
$router->get('/report/post/{id}', [ReportController::class, 'post']);
$router->get('/report/user/{username}', [ReportController::class, 'user']);
$router->get('/signup', [SignupController::class, 'signup']);
$router->post('/signup', [SignupController::class, 'signupForm']);
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'loginForm']);
$router->get('/about', [AboutController::class, 'index']);

$router->get('/ia', [ChatBotController::class, 'index']);
$router->post('/ia', [ChatBotController::class, 'perguntar']);

$router->post('/auth/check', [AuthController::class, 'check']);

$router->get('/user/{username}', [UserPageController::class, 'index']);

$router->get('/philosophers', [Philosophers::class, 'philosophers']);

$router->get('/philosophers/{name}', [Philosophers::class, 'philosophersProfile']);

$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact', [ContactController::class, 'form']);

$router->get('/post/create', [PostController::class, 'create']);
$router->post('/post/create', [PostController::class, 'createForm']);
$router->get('/post/{id}', [PostController::class, 'post']);
$router->get('/post/{id}/edit', [PostController::class, 'editPost']);
$router->post('/post/{id}/edit', [PostController::class, 'editPostForm']);

$router->get('/materials', [MaterialController::class, 'index']);
$router->get('/materials/create', [MaterialController::class, 'create']);
$router->get('/material/create', [MaterialController::class, 'create']);
$router->post('/material/create', [MaterialController::class, 'createForm']);
$router->get('/material/{id}', [MaterialController::class, 'material']);
$router->get('/material/{id}/edit', [MaterialController::class, 'edit']);
$router->post('/material/{id}/edit', [MaterialController::class, 'editForm']);

$router->get('/profile', [ProfileController::class, 'index']);

$router->get('/logout', [LogoutController::class, 'index']);

$router->get('/dashboard', [DashboardController::class, 'index']);

return $router;
