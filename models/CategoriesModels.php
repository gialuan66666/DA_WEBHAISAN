<?php
class CategoriesModels {
    private $pdo;

    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    
    public function getAllCategories() {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        return $this->pdo->query($sql)->fetchAll();
    }

    
    public function insertCategory($name, $slug, $description, $status) {
        $sql = "INSERT INTO categories (name, slug, description, status) VALUES (:name, :slug, :description, :status)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name'        => $name, 
            ':slug'        => $slug, 
            ':description' => $description, 
            ':status'      => $status
        ]);
    }

    public function updateCategory($id, $name, $slug, $description, $status) {
        $sql = "UPDATE categories SET name = :name, slug = :slug, description = :description, status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name'        => $name,
            ':slug'        => $slug,
            ':description' => $description,
            ':status'      => $status,
            ':id'          => $id
        ]);
    }

    public function deleteCategory($id) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}