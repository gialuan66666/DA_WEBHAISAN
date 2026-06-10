<?php

require_once './config/database.php';
require_once './models/OrderModels.php';

class OrderController
{
    private OrderModels $orderModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->orderModel = new OrderModels($db);
    }

    public function getAdminOrders(): array
    {
        return $this->orderModel->getAllOrders();
    }

    public function getOrderDetail(int $id): array
    {
        return [
            'order' => $this->orderModel->getOrderById($id),
            'items' => $this->orderModel->getOrderItems($id),
        ];
    }

    public function updateStatus(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/orders');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $status = $_POST['order_status'] ?? '';

        $allowedStatus = [
            'pending',
            'confirmed',
            'shipping',
            'completed',
            'cancelled'
        ];

        if ($id <= 0 || !in_array($status, $allowedStatus, true)) {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Dữ liệu đơn hàng không hợp lệ'
            ];

            header('Location: /admin/orders');
            exit;
        }

        $updated = $this->orderModel->updateOrderStatus($id, $status);

        $_SESSION['toast'] = [
            'type' => $updated ? 'success' : 'error',
            'message' => $updated ? 'Cập nhật đơn hàng thành công' : 'Cập nhật đơn hàng thất bại'
        ];
        header('Location: /admin/orders');
        exit;
    }
}
