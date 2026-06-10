<?php

require_once './config/database.php';
require_once './models/CartModels.php';
require_once './models/ProductsModels.php';

class CheckoutController
{
    private CartModel $cartModel;
    private ProductsModels $productModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $database = new Database();
        $db = $database->connect();

        $this->cartModel = new CartModel($db);
        $this->productModel = new ProductsModels($db);
    }

    public function index(): array
    {
        $userId = $_SESSION['user']['id'] ?? 1;

        if (isset($_SESSION['buy_now'])) {
            $productId = (int)$_SESSION['buy_now']['product_id'];
            $quantity = (int)$_SESSION['buy_now']['quantity'];

            $product = $this->productModel->getProductById($productId);

            if (!$product) {
                return [];
            }

            return [
                [
                    'product_id' => $product['id'],
                    'name' => $product['name'],
                    'image' => $product['image'],
                    'price' => $product['price'],
                    'unit' => $product['unit'] ?? 'kg',
                    'quantity' => $quantity
                ]
            ];
        }

        return $this->cartModel->getCartItems($userId);
    }
}