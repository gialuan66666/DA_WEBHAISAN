<?php

require_once './config/database.php';
require_once './models/CartModels.php';

class CartController
{
    private int $userId = 1;
    private CartModel $cartModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $database = new Database();
        $db = $database->connect();

        $this->cartModel = new CartModel($db);
    }

    public function index(): array
    {
        return $this->cartModel->getCartItems($this->userId);
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /product');
            exit;
        }

        $productId = (int)($_POST['product_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 1);

        if ($productId <= 0) {
            header('Location: /product');
            exit;
        }

        if ($quantity <= 0) {
            $quantity = 1;
        }

        $this->cartModel->addToCart($this->userId, $productId, $quantity);

        header('Location: /cart');
        exit;
    }

    public function buyNow(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /product');
            exit;
        }

        $productId = (int)($_POST['product_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 1);

        if ($productId <= 0) {
            header('Location: /product');
            exit;
        }

        if ($quantity <= 0) {
            $quantity = 1;
        }

        $_SESSION['buy_now'] = [
            'product_id' => $productId,
            'quantity' => $quantity
        ];

        header('Location: /checkout');
        exit;
    }

    public function remove(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /cart');
            exit;
        }

        $cartId = (int)($_POST['cart_id'] ?? 0);

        if ($cartId > 0) {
            $this->cartModel->removeItem($cartId, $this->userId);
        }

        header('Location: /cart');
        exit;
    }
}