<?php

require_once './config/database.php';
require_once './models/OrderModels.php';
require_once './models/ProductsModels.php';

class DashboardController
{
    private PDO $db;
    private OrderModels $orderModel;
    private ProductsModels $productModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();

        $this->orderModel = new OrderModels($this->db);
        $this->productModel = new ProductsModels($this->db);
    }

    public function index(): array
    {
        return [
            'revenue' => $this->orderModel->getRevenue(),
            'totalOrders' => $this->orderModel->getTotalOrders(),
            'totalProducts' => $this->productModel->getTotalProducts(),
            'orders' => $this->orderModel->getRecentOrders(5),
            'adminProducts' => $this->productModel->getLowStockProducts(5),
            'totalUsers' => $this->getTotalUsers(),
        ];
    }

    private function getTotalUsers(): array
    {
        $sql = "SELECT COUNT(*) AS total_users FROM users";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}