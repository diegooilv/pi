<?php

class PostService
{
    private $postModel;
    private $cloudinaryService;
    private const WORDS_PER_MINUTE = 150;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->cloudinaryService = new CloudinaryService();
    }

    public function createPost($authorId, array $data, $imageFile = null)
    {
       $imageUrl = null;

        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            $imageUrl = $this->cloudinaryService->upload($imageFile['tmp_name']);
        }

        $body = trim($data['body']);
        $readingTime = $this->calculateReadingTime($body);

        $postId = $this->postModel->create(
            $authorId,
            $data['category_id'],
            trim($data['title']),
            $body,
            $imageUrl,
            $readingTime,
            'published'
        );

        return $postId;
    }

    private function calculateReadingTime(string $body): int
    {
        $wordCount = str_word_count(strip_tags($body));
        $minutes = (int) ceil($wordCount / self::WORDS_PER_MINUTE);

        return max(1, min($minutes, 255));
    }

    public function getPostById($postId)
    {
        return $this->postModel->findById($postId);
    }

    public function getPosts($limit = 10, $offset = 0)
    {
        return $this->postModel->findPosts($limit, $offset);
    }
}