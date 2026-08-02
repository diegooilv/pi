<?php
class NavigationService
{
    private const MENUS = [
        'guest' => [
            'contact' => [
                'Início' => '/',
                'Filosofos' => '/philosophers'
            ],
            'home' => [
                'Início' => '/',
                'Filosofos' => '/philosophers',
                'Sobre' => '/about',
                'Entrar' => '/login',
            ],
            'login' => [
                'Início' => '/',
                'Sobre' => '/about',
                'Criar Conta' => '/signup',
            ],
            'signup' => [
                'Início' => '/',
                'Entrar' => '/login',
            ],
            'forgot_password' => [
                'Voltar' => '/login',
            ],
            'about' => [
                'Início' => '/',
                'Entrar' => '/login',
            ],
            'philosophers' => [
                'Início' => '/',
                'Sobre' => '/about',
                'Entrar' => '/login',
            ]
        ],

        'user' => [
            'home' => [
                'Início' => '/',
                'Dashboard' => '/dashboard',
                'Perfil' => '/profile',
                'Sair' => '/logout',
            ],

            'dashboard' => [
                'Início' => '/',
                'Posts' => '/posts',
                'Materiais' => '/materials',
                'Perfil' => '/profile',
            ],

            'posts' => [
                'Dashboard' => '/dashboard',
                'Criar Post' => '/posts/create',
            ],

            'materials' => [
                'Dashboard' => '/dashboard',
                'Adicionar Material' => '/materials/create',
            ],

            'profile' => [
                'Dashboard' => '/dashboard',
                'Editar Perfil' => '/profile/edit',
            ],
            'philosophers' => [
                'Início' => '/',
                'Sobre' => '/about',
                'Entrar' => '/login',
            ]
        ],

        'admin' => [
            'home' => [
                'Dashboard' => '/admin',
                'Usuários' => '/admin/users',
                'Posts' => '/admin/posts',
                'Materiais' => '/admin/materials',
            ],
            'moderation' => [
                'Voltar' => '/admin',
            ]
        ],
    ];

    public function getHeaderItems($page)
    {
        $logged = isset($_SESSION['auth']);
        $group = $logged ? 'user' : 'guest';

        return self::MENUS[$group][$page] ?? [];
    }
}