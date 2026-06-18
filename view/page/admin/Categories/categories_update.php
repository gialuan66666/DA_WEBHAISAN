<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = trim($_POST['name'] ?? '');
    $product_count = trim($_POST['product_count'] ?? '0');
    $status = $_POST['status'] ?? 1;
    
$slug = $name;

    if (!empty($id) && !empty($name)) {
        try {
            $db = new Database();
            $pdo = $db->connect();

            $sql = "UPDATE categories SET name = :name, slug = :slug, description = :description, status = :status WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':slug' => $slug,
                ':description' => $product_count,
                ':status' => $status,
                ':id' => $id
            ]);

            
            $_SESSION['toast'] = ['type' => 'success', 'message' => 'Cập nhật danh mục thành công!'];
        } catch (Exception $e) {
            $_SESSION['toast'] = ['type' => 'error', 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    } else {
        $_SESSION['toast'] = ['type' => 'warning', 'message' => 'Dữ liệu sửa không hợp lệ!'];
    }
}
header('Location: /admin/categories');
exit(); 
