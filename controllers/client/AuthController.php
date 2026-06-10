<?php

class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'fullname' => $_POST['fullname'] ?? '',
                'email'    => $_POST['email'] ?? '',
                'phone'    => $_POST['phone'] ?? '',
                'password' => $_POST['password'] ?? '',
                'status'   => 1
            ];

            if (in_array('', $data)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ!";
                header("Location: /register");
                exit;
            }

            if ($this->userModel->findByEmail($data['email'] ?? '')) {
                $_SESSION['error'] = "Email đã tồn tại!";
                header("Location: /register");
                exit;
            }
            //mã hóa mật khẩu 
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $result = $this->userModel->createUser($data);

            if ($result) {
                $_SESSION['success'] = "Đăng ký thành công!";
                header("Location: /login");
            } else {
                $_SESSION['error'] = "Đăng ký thất bại!";
                header("Location: /register");
            }
            exit;
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ!";
                header("Location: /login");
                exit;
            }

            $user = $this->userModel->findByEmail($email);

            if (!$user || !password_verify($password, $user['password'])) {
                $_SESSION['error'] = "Sai email hoặc mật khẩu!";
                header("Location: /login");
                exit;
            }

            $_SESSION['user'] = $user;

            header("Location: /");
            exit;
        }
    }
}
