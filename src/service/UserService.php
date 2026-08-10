<?php
class UserService
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getUserByUsername($username)
    {
        $user = $this->userModel->findByUsername($username);
        return $user;
    }

    public function getUserById($id)
    {
        $user = $this->userModel->findById($id);
        return $user;
    }
}