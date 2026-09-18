<?php

class PostModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function create($authorId, $categoryId, $title, $body, $image, $readingTime, $status = 'published')
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO posts (author_id, category_id, title, body, image, reading_time, status)
             VALUES (?,?,?,?,?,?,?)'
        );

        $stmt->execute([
            $authorId,
            $categoryId,
            $title,
            $body,
            $image,
            $readingTime,
            $status
        ]);

        return $this->pdo->lastInsertId();
    }

    public function findById(int $id)
    {
        $sql = "
        SELECT 
            posts.*,
            categories.name AS category_name,
            users.name AS author_name
        FROM posts
        INNER JOIN categories ON categories.id = posts.category_id
        INNER JOIN users ON users.id = posts.author_id
        WHERE posts.id = :id
          AND posts.deleted_at IS NULL
        LIMIT 1
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        return $post ?: null;
    }

    public function findByAuthor($authorId)
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM posts WHERE author_id = ? AND deleted_at IS NULL'
        );

        $stmt->execute([$authorId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByCategory($categoryId)
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM posts WHERE category_id = ? AND deleted_at IS NULL'
        );

        $stmt->execute([$categoryId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAll($status = null)
    {
        if ($status) {
            $stmt = $this->pdo->prepare(
                'SELECT * FROM posts WHERE status = ? AND deleted_at IS NULL ORDER BY created_at DESC'
            );

            $stmt->execute([$status]);
        } else {
            $stmt = $this->pdo->prepare(
                'SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY created_at DESC'
            );

            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findPosts($numberOfPosts = 10, $offset = 0)
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY created_at DESC LIMIT ? OFFSET ?'
        );

        $stmt->bindValue(1, (int) $numberOfPosts, PDO::PARAM_INT);
        $stmt->bindValue(2, (int) $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findLatestPosts($numberOfPosts = 10)
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY created_at DESC LIMIT ?'
        );

        $stmt->bindValue(1, (int) $numberOfPosts, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $fields = [];
        $values = [];

        foreach ($data as $column => $value) {
            $fields[] = "{$column} = ?";
            $values[] = $value;
        }

        $values[] = $id;

        $sql = "UPDATE posts SET " . implode(', ', $fields) . " WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($values);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM posts WHERE id = ?');
        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }

    public function toggleStatus($id, $published)
    {
        if ($published) {
            $stmt = $this->pdo->prepare(
                'UPDATE posts
                 SET status = ?, deleted_at = NULL
                 WHERE id = ?'
            );

            $stmt->execute(['published', $id]);
        } else {
            $stmt = $this->pdo->prepare(
                'UPDATE posts
                 SET status = ?
                 WHERE id = ?'
            );

            $stmt->execute(['archived', $id]);
        }

        return $stmt->rowCount() > 0;
    }

    public function softDelete($id)
    {
        $stmt = $this->pdo->prepare(
            'UPDATE posts SET deleted_at = NOW() WHERE id = ?'
        );

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }

    public function restore($id)
    {
        $stmt = $this->pdo->prepare(
            'UPDATE posts SET deleted_at = NULL WHERE id = ?'
        );

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }
}