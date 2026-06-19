<?php

class OrderModels
{
    private PDO $conn;
    private string $lastError = '';

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

    public function createOrder(array $orderData, array $items): int
    {
        if (empty($items)) {
            return 0;
        }

        try {
            $this->conn->beginTransaction();

            $orderId = $this->insertFiltered('orders', $orderData);

            foreach ($items as $item) {
                $item['order_id'] = $orderId;
                $this->insertFiltered('order_items', $item);
            }

            $this->conn->commit();

            return $orderId;
        } catch (Throwable $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }

            $this->lastError = $e->getMessage();

            return 0;
        }
    }

    public function getLastError(): string
    {
        return $this->lastError;
    }

    private function insertFiltered(string $table, array $data): int
    {
        $columns = $this->getTableColumns($table);
        $insertData = array_intersect_key($data, array_flip($columns));

        unset($insertData['id']);

        if (empty($insertData)) {
            throw new RuntimeException('No valid data for insert');
        }

        $fields = array_keys($insertData);
        $placeholders = array_map(fn($field) => ':' . $field, $fields);

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', $fields),
            implode(', ', $placeholders)
        );

        $stmt = $this->conn->prepare($sql);

        foreach ($insertData as $field => $value) {
            $stmt->bindValue(':' . $field, $value);
        }

        $stmt->execute();

        return (int)$this->conn->lastInsertId();
    }

    private function getTableColumns(string $table): array
    {
        $stmt = $this->conn->query('DESCRIBE ' . $table);

        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'Field');
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
