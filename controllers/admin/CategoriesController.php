<?php

require_once 'models/CategoriesModels.php';

class CategoriesController {
    private $categoryModel;

    public function __construct() {
        
        require_once 'config/database.php';
        
        $db = new Database();
        $pdo = $db->connect();

        
        $this->categoryModel = new CategoriesModels($pdo);
    }

    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        
        
        return $this->categoryModel->getAllCategories();
    }

    
    public function store() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
            $name = $_POST['name'];
            $status = $_POST['status']; 
            $product_count = $_POST['product_count']; 
            $slug = $name; 

            if (!empty($name)) {
                try {
                    // Gọi hàm insert từ Model
                    $this->categoryModel->insertCategory($name, $slug, $product_count, $status);
                    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Thêm danh mục thành công!'];
                } catch (Exception $e) {
                    $_SESSION['toast'] = ['type' => 'error', 'message' => 'Lỗi: ' . $e->getMessage()];
                }
            }
            
            header('Location: /admin/categories');
            exit();
        }
    }

    public function update() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id           = $_POST['id'] ?? null;
            $name         = trim($_POST['name'] ?? '');
            $product_count = trim($_POST['product_count'] ?? '');
            $status       = $_POST['status'] ?? 1;
            $slug         = $name;

            if (!empty($id) && !empty($name)) {
                try {
                    $this->categoryModel->updateCategory($id, $name, $slug, $product_count, $status);
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
    }

    public function destroy() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if (!empty($id)) {
                try {
                    $this->categoryModel->deleteCategory($id);
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
    }
}