<?php

class PostViewModel
{
    public function __construct(
        private array $post,
        private array $author
    ) {
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}