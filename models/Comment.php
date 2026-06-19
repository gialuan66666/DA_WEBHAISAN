<?php

class CommentModel
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function getByProduct($product_id)
    {
        $sql = "SELECT c.*, u.fullname 
                FROM comments c
                JOIN users u ON c.user_id = u.id
                WHERE c.product_id = :product_id
                ORDER BY c.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':product_id' => $product_id]);

        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $sql = "INSERT INTO comments (user_id, product_id, comment_text, rating)
        VALUES (:user_id, :product_id, :comment_text, :rating)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':product_id' => $data['product_id'],
            ':comment_text' => $data['content'],
            ':rating' => $data['rating']
        ]);
    }
}
