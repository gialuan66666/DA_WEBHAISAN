<?php

require_once './config/database.php';
require_once './models/UserModel.php';

class UserController
{
    private UserModel $userModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->userModel = new UserModel($db);
    }

    public function index(): array
    {
        return $this->userModel->getAllUsers();
    }

    public function show(int $id): ?array
    {
        return $this->userModel->getUserById($id);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/users/create');
            exit;
        }

        $data = [
            'fullname' => $_POST['fullname'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'password' => $_POST['password'] ?? '',
            'address' => $_POST['address'] ?? '',
            'status' => $_POST['status'] ?? 1,
        ];

        $created = $this->userModel->createUser($data);

        $this->setToast(
            $created ? 'success' : 'error',
            $created ? 'Thêm khách hàng thành công' : 'Thêm thất bại'
        );

        header('Location: /admin/users');
        exit;
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/users');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);

        $data = [
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'status' => $_POST['status'],
        ];

        $updated = $this->userModel->updateUser($id, $data);

        $this->setToast(
            $updated ? 'success' : 'error',
            $updated ? 'Cập nhật thành công' : 'Cập nhật thất bại'
        );

        header('Location: /admin/users');
        exit;
    }

    public function destroy(): void
    {
        if (!isset($_POST['id'])) {
            header('Location: /admin/users');
            exit;
        }

        $deleted = $this->userModel->deleteUser((int)$_POST['id']);

        $this->setToast(
            $deleted ? 'success' : 'error',
            $deleted ? 'Xóa thành công' : 'Xóa thất bại'
        );

        header('Location: /admin/users');
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
}
