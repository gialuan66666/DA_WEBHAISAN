<?php

class OrderModels
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function getAllOrders(): array
    {
        $sql = "
            SELECT *
            FROM orders
            ORDER BY id DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById(int $id): ?array
    {
        $sql = "
            SELECT *
            FROM orders
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        return $order ?: null;
    }

    public function getOrderItems(int $orderId): array
    {
        $sql = "
            SELECT *
            FROM order_items
            WHERE order_id = :order_id
            ORDER BY id ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':order_id' => $orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public function updateOrderStatus(int $id, string $status): bool
{
    $sql = "
        UPDATE orders
        SET order_status = :order_status
        WHERE id = :id
    ";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':id' => $id,
        ':order_status' => $status
    ]);
}
}