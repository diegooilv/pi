<?php

class AuthService
{
    private UserModel $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function isLogged()
    {
        return isset($_SESSION['auth']);
    }
    public function isEmailRegistered($email)
    {
        return $this->userModel->findByEmail($email) !== false;
    }

    public function isUsernameRegistred($username)
    {
        return $this->userModel->findByUsername($username);

    }

    public function requireLogin()
    {
        if (!$this->isLogged()) {
            header('Location: /login');
            exit;
        }
    }
    public function login($email, $password)
    {
        $email = trim(strtolower($email));

        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            die("USER NOT FOUND");
        }

        if (!password_verify($password, $user['password_hash'])) {
            die("PASSWORD WRONG");
        }

        if (!$user['active']) {
            die("USER INACTIVE");
        }

        $_SESSION['auth'] = [
            'id' => $user['id'],
            'role' => $user['role']
        ];

        return true;
    }

    public function signup($name, $username, $email, $password_hash, $bio, $image_url)
    {
        try {

            $id = $this->userModel->create($name, $username, $email, $password_hash, $bio, $image_url);
            $_SESSION['auth'] = [
                'id' => $id,
                'role' => 'user'
            ];
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        header('Location: /login');
    }
     public function isAdmin()
    {
        return $this->isLogged() && $_SESSION['auth']['role'] === 'admin';
    }
}