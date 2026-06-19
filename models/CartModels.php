<?php

class CartModel
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function addToCart(int $userId, int $productId, int $quantity): bool
    {
        $sql = "
            SELECT id, quantity
            FROM cart_items
            WHERE user_id = :user_id
            AND product_id = :product_id
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':product_id' => $productId
        ]);

        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cart) {
            $sql = "
                UPDATE cart_items
                SET quantity = quantity + :quantity
                WHERE id = :id
                AND user_id = :user_id
            ";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':quantity' => $quantity,
                ':id' => $cart['id'],
                ':user_id' => $userId
            ]);
        }

        $sql = "
            INSERT INTO cart_items (user_id, product_id, quantity)
            VALUES (:user_id, :product_id, :quantity)
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':product_id' => $productId,
            ':quantity' => $quantity
        ]);
    }

    public function getCartItems(int $userId): array
    {
        $sql = "
            SELECT
                c.id AS cart_id,
                c.product_id,
                c.quantity,
                p.name,
                p.image,
                p.price,
                p.unit
            FROM cart_items c
            INNER JOIN products p ON p.id = c.product_id
            WHERE c.user_id = :user_id
            ORDER BY c.id DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeItem(int $cartId, int $userId): bool
    {
        $sql = "
            DELETE FROM cart_items
            WHERE id = :id
            AND user_id = :user_id
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $cartId,
            ':user_id' => $userId
        ]);
    }

    public function updateQuantity(int $cartId, int $userId, int $quantity): bool
    {
        if ($quantity < 1) {
            return $this->removeItem($cartId, $userId);
        }

        $sql = "
            UPDATE cart_items
            SET quantity = :quantity
            WHERE id = :id
            AND user_id = :user_id
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':quantity' => $quantity,
            ':id' => $cartId,
            ':user_id' => $userId
        ]);
    }

    public function clearCart(int $userId): bool
    {
        $sql = "
            DELETE FROM cart_items
            WHERE user_id = :user_id
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId
        ]);
    }
}
