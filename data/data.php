<?php

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->connect();

function fetchAllSafe(PDO $conn, string $sql): array
{
    try {
        $stmt = $conn->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function priceFormat($price): string
{
    return number_format((float) $price, 0, ',', '.') . 'đ';
}

function getProductById(array $products, $id): ?array
{
    foreach ($products as $product) {
        if ((string) ($product['id'] ?? '') === (string) $id) {
            return $product;
        }
    }

    return $products[0] ?? null;
}

$products = fetchAllSafe(
    $conn,
    "SELECT products.*, categories.name AS category_name
     FROM products
     LEFT JOIN categories ON products.category_id = categories.id
     ORDER BY products.id DESC"
);

$categories = fetchAllSafe($conn, "SELECT * FROM categories ORDER BY id DESC");

foreach ($products as &$product) {
    $product['category'] = $product['category'] ?? ($product['category_name'] ?? '');
    $product['unit'] = $product['unit'] ?? 'kg';
    $product['old_price'] = $product['old_price'] ?? ((float) ($product['price'] ?? 0) * 1.2);
    $product['desc'] = $product['desc'] ?? ($product['description'] ?? '');
}
unset($product);

foreach ($categories as &$category) {
    $category['icon'] = $category['icon'] ?? 'fa-fish';
}
unset($category);

$adminProducts = $products;

$customers = fetchAllSafe(
    $conn,
    "SELECT
        users.*,
        COUNT(orders.id) AS orders,
        COALESCE(SUM(orders.total), 0) AS spent
     FROM users
     LEFT JOIN orders ON orders.user_id = users.id
     GROUP BY users.id
     ORDER BY users.id DESC"
);

if (session_status() === PHP_SESSION_ACTIVE && !isset($_SESSION['users'])) {
    $_SESSION['users'] = $customers;
}
