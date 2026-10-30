<?php

class UserModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function create($name, $username, $email, $password_hash, $bio, $image_url)
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (name, username, email, password_hash, bio, image_url)
             VALUES (?,?,?,?,?,?)'
        );
        $email = trim(strtolower($email));
        $stmt->execute([
            $name,
            $username,
            $email,
            $password_hash,
            $bio,
            $image_url
        ]);

        return $this->pdo->lastInsertId();
    }

    public function findByEmail($email)
    {
        $email = trim(strtolower($email));
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE email = ?'
        );

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUsername($username)
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE username = ?'
        );

        $stmt->execute([$username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE id = ?'
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $allowedColumns = ['name', 'username', 'email', 'password_hash', 'bio', 'image_url'];
        $fields = [];
        $values = [];

        foreach ($data as $column => $value) {
            if (!in_array($column, $allowedColumns, true)) {
                throw new InvalidArgumentException('Invalid user column.');
            }

            $fields[] = "{$column} = ?";
            $values[] = $value;
        }

        if ($fields === []) {
            throw new InvalidArgumentException('No user data to update.');
        }

        $values[] = $id;

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($values);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }

    public function toggleActive($id, $active)
    {
        if ($active) {
            $stmt = $this->pdo->prepare(
                'UPDATE users
                 SET active = ?, disabled_at = NULL
                 WHERE id = ?'
            );

            $stmt->execute([1, $id]);
        } else {
            $stmt = $this->pdo->prepare(
                'UPDATE users
                 SET active = ?, disabled_at = NOW()
                 WHERE id = ?'
            );

            $stmt->execute([0, $id]);
        }

        return $stmt->rowCount() > 0;
    }

    public function toggleAdm($id, $boolean)
    {
        $stmt = $this->pdo->prepare('UPDATE users SET role = ? WHERE id = ?');

        if ($boolean) {
            $stmt->execute(['admin', $id]);
        } else {
            $stmt->execute(['user', $id]);
        }

        return $stmt->rowCount() > 0;
    }
}
