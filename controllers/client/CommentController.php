<?php

require_once './models/Comment.php';

class CommentController
{
    private $commentModel;

    public function __construct($db)
    {
        $this->commentModel = new CommentModel($db);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /");
            exit;
        }

        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Bạn cần đăng nhập!";
            header("Location: /login");
            exit;
        }

        $data = [
            'user_id' => $_SESSION['user']['id'],
            'product_id' => $_POST['product_id'],
            'content' => $_POST['content'],
            'rating' => $_POST['rating'] ?? 5
        ];

        if (empty($data['content'])) {
            $_SESSION['error'] = "Vui lòng nhập nội dung!";
            header("Location: /productdetail?id=" . $data['product_id']);
            exit;
        }

        $result = $this->commentModel->create($data);

        $_SESSION[$result ? 'success' : 'error'] =
            $result ? "Đánh giá thành công!" : "Thất bại!";

        header("Location: /productdetail?id=" . $data['product_id']);
        exit;
    }
}