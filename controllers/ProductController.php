<?php

require_once './config/database.php';

class ProductController
{
    private $conn;

    public function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();
    }

    public function getAllProducts()
    {
        $sql = "
            SELECT 
                products.*,
                categories.name AS category_name
            FROM products

            LEFT JOIN categories
            ON products.category_id = categories.id

            ORDER BY products.id DESC
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getProductById($id)
    {
        $sql = "
            SELECT 
                products.*,
                categories.name AS category_name
            FROM products
            LEFT JOIN categories
                ON products.category_id = categories.id
            WHERE products.id = :id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

}
