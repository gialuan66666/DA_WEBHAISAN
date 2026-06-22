<?php

require_once './models/CategoryModel.php';

class CategoryController
{
    private CategoryModel $model;

    public function __construct()
    {
        $db = (new Database())->connect();
        $this->model = new CategoryModel($db);
    }

    public function index()
    {
        return $this->model->getAll();
    }
    private function createSlug($string)
    {
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]+/', '-', $string);
        return trim($string, '-');
    }

    private function uploadImage()
    {
        if (!empty($_FILES['image']['name'])) {
            $targetDir = "uploads/";
            $fileName = time() . '_' . basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                return $targetFile;
            }
        }
        return null;
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /admin/categories");
            exit;
        }

        $name = trim($_POST['name'] ?? '');

        if (empty($name)) {
            $this->setToast('error', 'Tên danh mục không được để trống');
            header("Location: /admin/categories");
            exit;
        }

        $slug = $this->createSlug($name);

        if ($this->model->slugExists($slug)) {
            $slug .= '-' . time();
        }

        $image = $this->uploadImage();

        $created = $this->model->create([
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'description' => $_POST['description'] ?? '',
            'status' => $_POST['status'] ?? 1,
        ]);

        $this->setToast(
            $created ? 'success' : 'error',
            $created ? 'Thêm danh mục thành công' : 'Thêm thất bại'
        );

        header("Location: /admin/categories");
        exit;
    }


    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /admin/categories");
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');

        if (!$id || empty($name)) {
            $this->setToast('error', 'Dữ liệu không hợp lệ');
            header("Location: /admin/categories");
            exit;
        }

        $slug = $this->createSlug($name);

        if ($this->model->slugExists($slug, $id)) {
            $slug .= '-' . time();
        }

        $image = $_POST['old_image'] ?? null;

        $updated = $this->model->update($id, [
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'description' => $_POST['description'] ?? '',
            'status' => $_POST['status'] ?? 1,
        ]);

        $this->setToast(
            $updated ? 'success' : 'error',
            $updated ? 'Cập nhật thành công' : 'Cập nhật thất bại'
        );

        header("Location: /admin/categories");
        exit;
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/categories');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);

        if (!$id) {
            $this->setToast('error', 'ID không hợp lệ');
            header('Location: /admin/categories');
            exit;
        }

        $deleted = $this->model->delete($id);

        $this->setToast(
            $deleted ? 'success' : 'error',
            $deleted ? 'Xóa thành công' : 'Xóa thất bại'
        );

        header('Location: /admin/categories');
        exit;
    }

    private function setToast(string $type, string $message)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['toast'] = [
            'type' => $type,
            'message' => $message,
        ];
    }
}
