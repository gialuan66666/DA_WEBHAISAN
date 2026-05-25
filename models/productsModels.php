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
    public function createProduct(array $data): bool
    {
        $sql = "
        INSERT INTO products (
            category_id,
            name,
            slug,
            image,
            old_price,
            price,
            unit,
            quantity,
            badge,
            description,
            is_flash_sale,
            is_featured,
            status
        ) VALUES (
            :category_id,
            :name,
            :slug,
            :image,
            :old_price,
            :price,
            :unit,
            :quantity,
            :badge,
            :description,
            :is_flash_sale,
            :is_featured,
            :status
        )
    ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':category_id' => $data['category_id'],
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':image' => $data['image'],
            ':old_price' => $data['old_price'],
            ':price' => $data['price'],
            ':unit' => $data['unit'],
            ':quantity' => $data['quantity'],
            ':badge' => $data['badge'],
            ':description' => $data['description'],
            ':is_flash_sale' => $data['is_flash_sale'],
            ':is_featured' => $data['is_featured'],
            ':status' => $data['status'],
        ]);
    }

    public function getAllCategories(): array
    {
        $sql = "SELECT id, name FROM categories ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getProductById(int $id): ?array
{
    $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    $product = $stmt->fetch();

    return $product ?: null;
}

public function updateProduct(int $id, array $data): bool
{
    $sql = "
        UPDATE products SET
            category_id = :category_id,
            name = :name,
            slug = :slug,
            image = :image,
            old_price = :old_price,
            price = :price,
            unit = :unit,
            quantity = :quantity,
            badge = :badge,
            description = :description,
            status = :status
        WHERE id = :id
    ";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':id' => $id,
        ':category_id' => $data['category_id'],
        ':name' => $data['name'],
        ':slug' => $data['slug'],
        ':image' => $data['image'],
        ':old_price' => $data['old_price'],
        ':price' => $data['price'],
        ':unit' => $data['unit'],
        ':quantity' => $data['quantity'],
        ':badge' => $data['badge'],
        ':description' => $data['description'],
        ':status' => $data['status'],
    ]);
}
}
