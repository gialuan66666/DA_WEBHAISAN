<?php

require_once './config/database.php';
require_once './models/CartModels.php';
require_once './models/ProductsModels.php';
require_once './models/OrderModels.php';

class CheckoutController
{
    private CartModel $cartModel;
    private ProductsModels $productModel;
    private OrderModels $orderModel;
    private int $shippingFee = 30000;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $database = new Database();
        $db = $database->connect();

        $this->cartModel = new CartModel($db);
        $this->productModel = new ProductsModels($db);
        $this->orderModel = new OrderModels($db);
    }

    public function index(): array
    {
        if (empty($_SESSION['user']['id'])) {
            $_SESSION['error'] = "Vui long dang nhap de thanh toan";
            header("Location: /login");
            exit;
        }

        $userId = (int)$_SESSION['user']['id'];

        if (($_GET['source'] ?? '') === 'cart') {
            unset($_SESSION['buy_now']);
        }

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

    public function order(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /checkout');
            exit;
        }

        if (empty($_SESSION['user']['id'])) {
            $_SESSION['error'] = "Vui long dang nhap de thanh toan";
            header("Location: /login");
            exit;
        }

        $userId = (int)$_SESSION['user']['id'];
        $items = $this->getCheckoutItems($userId);

        if (empty($items)) {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Gio hang dang trong'
            ];
            header('Location: /cart');
            exit;
        }

        $customerName = trim($_POST['customer_name'] ?? '');
        $customerPhone = trim($_POST['customer_phone'] ?? '');
        $customerEmail = trim($_POST['customer_email'] ?? '');
        $customerAddress = trim($_POST['customer_address'] ?? '');
        $note = trim($_POST['note'] ?? '');
        $paymentMethod = 'cod';

        if ($customerName === '' || $customerPhone === '' || $customerAddress === '') {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Vui long nhap day du ho ten, so dien thoai va dia chi'
            ];
            header('Location: /checkout');
            exit;
        }

        $subtotal = 0;
        $orderItems = [];

        foreach ($items as $item) {
            $quantity = max(1, (int)($item['quantity'] ?? 1));
            $price = (float)($item['price'] ?? 0);
            $lineTotal = $price * $quantity;
            $subtotal += $lineTotal;

            $orderItems[] = [
                'product_id' => $item['product_id'] ?? null,
                'product_name' => $item['name'] ?? '',
                'product_image' => $item['image'] ?? null,
                'price' => $price,
                'quantity' => $quantity,
                'total' => $lineTotal
            ];
        }

        $orderData = [
            'user_id' => $userId,
            'customer_name' => $customerName,
            'customer_phone' => $customerPhone,
            'customer_email' => $customerEmail,
            'customer_address' => $customerAddress,
            'note' => $note,
            'payment_method' => $paymentMethod,
            'subtotal' => $subtotal,
            'discount' => 0,
            'shipping_fee' => $this->shippingFee,
            'total' => $subtotal + $this->shippingFee,
            'order_status' => 'pending',
            'payment_status' => 'unpaid',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $orderId = $this->orderModel->createOrder($orderData, $orderItems);

        if ($orderId <= 0) {
            $errorMessage = 'Dat hang that bai, vui long thu lai';
            $lastError = $this->orderModel->getLastError();

            if ($lastError !== '') {
                $errorMessage .= ': ' . $lastError;
            }

            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => $errorMessage
            ];
            header('Location: /checkout');
            exit;
        }

        if (isset($_SESSION['buy_now'])) {
            unset($_SESSION['buy_now']);
        } else {
            $this->cartModel->clearCart($userId);
        }

        $_SESSION['order_success_id'] = $orderId;
        header('Location: /checkout?success=1');
        exit;
    }

    private function getCheckoutItems(int $userId): array
    {
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
