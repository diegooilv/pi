<?php

class CategoryModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT id, name FROM categories ORDER BY name');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exists(int $id): bool
    {
        $stmt = $this->pdo->prepare('SELECT 1 FROM categories WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        return (bool) $stmt->fetchColumn();
    }
}
