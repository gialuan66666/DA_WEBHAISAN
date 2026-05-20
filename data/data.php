<?php
// Data mẫu cho trang client (home) khi chưa có query từ DB.
// Các page đang include file này để lấy $products, $categories.

// Nếu bạn đã build data từ DB riêng, có thể thay thế nội dung này.

$products = $products ?? [];
$categories = $categories ?? [
    ['name' => 'Hải sản tươi sống', 'icon' => 'fa-fish-fins'],
    ['name' => 'Hải sản đông lạnh', 'icon' => 'fa-snowflake'],
    ['name' => 'Đồ khô', 'icon' => 'fa-drumstick-bite'],
    ['name' => 'Gia vị & sơ chế', 'icon' => 'fa-seedling'],
];

