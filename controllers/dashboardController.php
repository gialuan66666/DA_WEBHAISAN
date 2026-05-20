<?php

require_once './config/database.php';

class DashboardController
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Tổng doanh thu
    public function getRevenue()
    {
        $sql = "SELECT SUM(total) as revenue FROM orders";

        $stmt = $this->conn->query($sql);

        return $stmt->fetch();
    }

    // Tổng đơn hàng
    public function getTotalOrders()
    {
        $sql = "SELECT COUNT(*) as total_orders FROM orders";

        $stmt = $this->conn->query($sql);

        return $stmt->fetch();
    }

    // Tổng sản phẩm
    public function getTotalProducts()
    {
        $sql = "SELECT COUNT(*) as total_products FROM products";

        $stmt = $this->conn->query($sql);

        return $stmt->fetch();
    }

    // Tổng khách hàng
    public function getTotalUsers()
    {
        $sql = "SELECT COUNT(*) as total_users FROM users";

        $stmt = $this->conn->query($sql);

        return $stmt->fetch();
    }

    // Đơn hàng mới nhất
    public function getLatestOrders()
    {
        $sql = "
            SELECT *
            FROM orders
            ORDER BY created_at DESC
            LIMIT 5
        ";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll();
    }

    // Sản phẩm sắp hết
    public function getLowStockProducts()
    {
        $sql = "
            SELECT *
            FROM products
            ORDER BY quantity ASC
            LIMIT 5
        ";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll();
    }
}