<?php
class ReportService
{
    private PostModel $postModel;
    private UserModel $userModel;
    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->userModel = new UserModel();
    }

    public function getMaterial($id)
    {
        //

    }
    //
    public function getPost($id)
    {
        return $this->postModel->findById($id);
    }

    public function getAuthor($id)
    {
        return $this->userModel->findById($id);
    }
}