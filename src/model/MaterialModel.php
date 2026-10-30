<?php
// title, type, author_id
// description, image, ur
// category_id

class MaterialModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function create($title, $description, $imageUrl, $type, $url, $authorId, $categoryId = 1)
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO materials (title, description, image, type, url, author_id, category_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)'
        );

        $stmt->execute([
            $title,
            $description,
            $imageUrl,
            $type,
            $url,
            $authorId,
            $categoryId
        ]);

        return $this->pdo->lastInsertId();
    }

    public function findByAuthor($authorId, $limit = 10, $offset = 0)
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM materials WHERE author_id = ? AND deleted_at IS NULL ORDER BY created_at DESC LIMIT ? OFFSET ?'
        );
        $stmt->bindValue(1, (int) $authorId, PDO::PARAM_INT);
        $stmt->bindValue(2, (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(3, (int) $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare(
            'SELECT materials.*, categories.name AS category_name, users.name AS author_name,
                    users.username AS author_username
             FROM materials
             INNER JOIN categories ON categories.id = materials.category_id
             INNER JOIN users ON users.id = materials.author_id
             WHERE materials.id = ? AND materials.deleted_at IS NULL LIMIT 1'
        );
        $stmt->execute([
            $id
        ]);

        $material = $stmt->fetch(PDO::FETCH_ASSOC);
        return $material ?: null;
    }

    public function findByType($type)
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM materials WHERE type = ?'
        );
        $stmt->execute([
            $type
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($query)
    {
        $search = "%{$query}%";

        $stmt = $this->pdo->prepare(
            'SELECT *
         FROM materials
         WHERE title LIKE ?
            OR description LIKE ?'
        );

        $stmt->execute([
            $search,
            $search
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function edit($id, array $data)
    {
        $allowed = [
            'title',
            'description',
            'image',
            'type',
            'url',
            'category_id'
        ];

        $fields = [];
        $values = [];

        foreach ($data as $column => $value) {
            if (!in_array($column, $allowed, true)) {
                continue;
            }

            $fields[] = "{$column} = ?";
            $values[] = $value;
        }

        if (empty($fields)) {
            return false;
        }

        $values[] = $id;

        $sql = sprintf(
            'UPDATE materials SET %s WHERE id = ?',
            implode(', ', $fields)
        );

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($values);
    }

    public function findMaterials($limit = 10, $offset = 0)
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM materials WHERE deleted_at IS NULL ORDER BY created_at DESC LIMIT ? OFFSET ?'
        );
        $stmt->bindValue(1, (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count(): int
    {
        $stmt = $this->pdo->query('SELECT COUNT(*) FROM materials WHERE deleted_at IS NULL');
        return (int) $stmt->fetchColumn();
    }
}
