<?php

require_once './config/database.php';
require_once './models/productsModels.php';

class ProductController
{
    private ProductsModels $productModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->productModel = new ProductsModels($db);
    }

    public function getAdminProducts(): array
    {
        return $this->productModel->getAllProducts();
    }

    public function getCategories(): array
    {
        return $this->productModel->getAllCategories();
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/products/create');
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $price = (float)($_POST['price'] ?? 0);

        if ($name === '' || $price <= 0) {
            $this->setToast('error', 'Vui long nhap ten san pham va gia ban hop le');
            header('Location: /admin/products/create');
            exit;
        }

        try {
            $imagePath = $this->uploadImage();
        } catch (RuntimeException $e) {
            $this->setToast('error', $e->getMessage());
            header('Location: /admin/products/create');
            exit;
        }

        $data = [
            'category_id' => !empty($_POST['category_id']) ? $_POST['category_id'] : null,
            'name' => $name,
            'slug' => $this->createSlug($name),
            'image' => $imagePath,
            'old_price' => !empty($_POST['old_price']) ? $_POST['old_price'] : 0,
            'price' => $price,
            'unit' => trim($_POST['unit'] ?? 'kg'),
            'quantity' => !empty($_POST['quantity']) ? $_POST['quantity'] : 0,
            'badge' => 'Tuoi song 100%',
            'description' => trim($_POST['description'] ?? ''),
            'is_flash_sale' => 0,
            'is_featured' => 0,
            'status' => $_POST['status'] ?? 'available',
        ];

        $created = $this->productModel->createProduct($data);
        $this->setToast(
            $created ? 'success' : 'error',
            $created ? 'Thêm Sản Phẩm Thành Công' : 'Thêm Sản Phẩm Thất Bại'
        );

        header('Location: /admin/products');
        exit;
    }

    private function uploadImage(): ?string
    {
        if (empty($_FILES['image']['name'])) {
            return null;
        }

        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Upload anh that bai');
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);

        if (!in_array($fileType, $allowedTypes, true)) {
            throw new RuntimeException('Chi cho phep upload anh JPG, PNG, WEBP hoac GIF');
        }

        $uploadDir = __DIR__ . './../../uploads/products/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('product_', true) . '.' . strtolower($extension);
        $targetPath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            throw new RuntimeException('Khong the luu anh');
        }

        return '/uploads/products/' . $fileName;
    }

    private function createSlug(string $text): string
    {
        $text = trim($text);
        $text = mb_strtolower($text, 'UTF-8');

        $text = preg_replace([
            '/[áàảãạăắằẳẵặâấầẩẫậ]/u',
            '/[éèẻẽẹêếềểễệ]/u',
            '/[íìỉĩị]/u',
            '/[óòỏõọôốồổỗộơớờởỡợ]/u',
            '/[úùủũụưứừửữự]/u',
            '/[ýỳỷỹỵ]/u',
            '/đ/u',
            '/[^a-z0-9\s-]/',
            '/[\s-]+/'
        ], [
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            '',
            '-'
        ], $text);

        return trim($text, '-') . '-' . time();
    }

    public function getProductById(int $id): ?array
    {
        return $this->productModel->getProductById($id);
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/products');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $oldProduct = $this->productModel->getProductById($id);

        if (!$oldProduct) {
            $this->setToast('error', 'Khong tim thay san pham');
            header('Location: /admin/products');
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $price = (float)($_POST['price'] ?? 0);

        if ($name === '' || $price <= 0) {
            $this->setToast('error', 'Vui long nhap ten san pham va gia ban hop le');
            header('Location: /admin/products/edit?id=' . $id);
            exit;
        }

        $imagePath = $oldProduct['image'];

        if (!empty($_FILES['image']['name'])) {
            try {
                $newImage = $this->uploadImage();
            } catch (RuntimeException $e) {
                $this->setToast('error', $e->getMessage());
                header('Location: /admin/products/edit?id=' . $id);
                exit;
            }

            if ($newImage !== null) {
                $imagePath = $newImage;
            }
        }

        $data = [
            'category_id' => !empty($_POST['category_id']) ? $_POST['category_id'] : null,
            'name' => $name,
            'slug' => $this->createSlug($name),
            'image' => $imagePath,
            'old_price' => !empty($_POST['old_price']) ? $_POST['old_price'] : 0,
            'price' => $price,
            'unit' => trim($_POST['unit'] ?? 'kg'),
            'quantity' => !empty($_POST['quantity']) ? $_POST['quantity'] : 0,
            'badge' => $oldProduct['badge'] ?? 'Tuoi song 100%',
            'description' => trim($_POST['description'] ?? ''),
            'status' => $_POST['status'] ?? 'available',
        ];

        $updated = $this->productModel->updateProduct($id, $data);
        $this->setToast(
            $updated ? 'success' : 'error',
            $updated ? 'Cập nhật sản phẩm thành công' : 'Cập nhật sản phẩm thất bại'
        );

        header('Location: /admin/products');
        exit;
    }

    private function setToast(string $type, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['toast'] = [
            'type' => $type,
            'message' => $message,
        ];
    }
public function destroy()
{
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        $this->setToast('error', 'ID sản phẩm không hợp lệ');
        header("Location: /admin/products");
        exit;
    }

    $id = (int) $_POST['id'];

    $deleted = $this->productModel->deleteProduct($id);

    if ($deleted) {
        $this->setToast('success', 'Xóa sản phẩm thành công');
    } else {
        $this->setToast('error', 'Xóa sản phẩm thất bại');
    }

    header("Location: /admin/products");
    exit;
}
}
