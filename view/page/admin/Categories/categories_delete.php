<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once 'config/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!empty($id)) {
        try {
            $db = new Database();
            $pdo = $db->connect();

            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);

            
            $_SESSION['toast'] = ['type' => 'success', 'message' => 'Xóa danh mục thành công!'];
        } catch (Exception $e) {
            $_SESSION['toast'] = ['type' => 'error', 'message' => 'Không thể xóa do ràng buộc dữ liệu!'];
        }
    } else {
        $_SESSION['toast'] = ['type' => 'warning', 'message' => 'Không tìm thấy danh mục để xóa.'];
    }
}
header('Location: /admin/categories');
exit();
