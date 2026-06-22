<?php
class CategoryModel
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function getAll(): array
    {
        try {
            $stmt = $this->conn->prepare("
            SELECT c.*, 
            (SELECT COUNT(*) FROM products p WHERE p.category_id = c.id) as product_count
            FROM categories c
            ORDER BY c.id DESC
        ");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }


    public function findById(int $id): ?array
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT * FROM categories 
                WHERE id = :id AND deleted_at IS NULL
                LIMIT 1
            ");
            $stmt->execute([':id' => $id]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function create(array $data): bool
    {
        try {
            $sql = "INSERT INTO categories (name, slug, image, description, status)
                    VALUES (:name, :slug, :image, :description, :status)";
            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':name' => $data['name'] ?? '',
                ':slug' => $data['slug'] ?? '',
                ':image' => $data['image'] ?? null,
                ':description' => $data['description'] ?? '',
                ':status' => $data['status'] ?? 1,
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update(int $id, array $data): bool
    {
        try {
            $sql = "UPDATE categories SET
                        name = :name,
                        slug = :slug,
                        image = :image,
                        description = :description,
                        status = :status
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':id' => $id,
                ':name' => $data['name'] ?? '',
                ':slug' => $data['slug'] ?? '',
                ':image' => $data['image'] ?? null,
                ':description' => $data['description'] ?? '',
                ':status' => $data['status'] ?? 1,
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->conn->prepare("
            DELETE FROM categories 
            WHERE id = :id
        ");

            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function slugExists(string $slug, ?int $ignoreId = null): bool
    {
        try {
            $sql = "SELECT id FROM categories WHERE slug = :slug";
            if ($ignoreId) {
                $sql .= " AND id != :id";
            }

            $stmt = $this->conn->prepare($sql);

            $params = [':slug' => $slug];
            if ($ignoreId) {
                $params[':id'] = $ignoreId;
            }

            $stmt->execute($params);

            return $stmt->fetch() ? true : false;
        } catch (PDOException $e) {
            return true;
        }
    }
}
