<?php

class ProductsModels
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function getAllProducts(): array
    {
        $sql = "
            SELECT 
                p.id,
                p.name,
                p.image,
                p.price,
                p.quantity,
                p.status,
                c.name AS category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}