<?php

class UserModel
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getUserById(int $id): ?array
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function createUser(array $data): bool
    {
        $sql = "
            INSERT INTO users (fullname, email, phone, password, address, status)
            VALUES (:fullname, :email, :phone, :password, :address, :status)
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':fullname' => $data['fullname'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':password' => $data['password'],
            ':address' => $data['address'],
            ':status' => $data['status'],
        ]);
    }

    public function updateUser(int $id, array $data): bool
    {
        $sql = "
            UPDATE users SET
                fullname = :fullname,
                email = :email,
                phone = :phone,
                address = :address,
                status = :status
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':fullname' => $data['fullname'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':status' => $data['status'],
        ]);
    }

    public function deleteUser(int $id): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch();
    }
}
