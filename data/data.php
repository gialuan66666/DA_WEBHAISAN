<?php
$categories = [
    ['name' => 'Hải sản tươi sống', 'icon' => 'fa-fish'],
    ['name' => 'Hải sản đông lạnh', 'icon' => 'fa-snowflake'],
    ['name' => 'Đồ khô', 'icon' => 'fa-shrimp'],
    ['name' => 'Gia vị & Sơ chế', 'icon' => 'fa-bowl-food'],
];

$products = [
    [
        'id' => 1,
        'name' => 'Tôm Hùm Bông',
        'unit' => 'kg',
        'old_price' => 1250000,
        'price' => 990000,
        'image' => 'https://images.unsplash.com/photo-1559737558-2f5a35f4523b?auto=format&fit=crop&w=800&q=80',
        'category' => 'Hải sản tươi sống',
        'desc' => 'Tôm hùm bông sống khỏe, thịt chắc, vị ngọt tự nhiên, phù hợp hấp bia hoặc nướng phô mai.'
    ],
    [
        'id' => 2,
        'name' => 'Cua Cà Mau',
        'unit' => 'con',
        'old_price' => 690000,
        'price' => 550000,
        'image' => 'https://images.unsplash.com/photo-1625944525533-473f1a3d54e7?auto=format&fit=crop&w=800&q=80',
        'category' => 'Hải sản tươi sống',
        'desc' => 'Cua Cà Mau chắc thịt, gạch béo, được tuyển chọn kỹ trước khi giao.'
    ],
    [
        'id' => 3,
        'name' => 'Mực Lá Đại Dương',
        'unit' => 'kg',
        'old_price' => 420000,
        'price' => 350000,
        'image' => 'https://images.unsplash.com/photo-1606851091851-e8c8c0fca5ba?auto=format&fit=crop&w=800&q=80',
        'category' => 'Hải sản tươi sống',
        'desc' => 'Mực lá tươi, thân dày, thích hợp hấp gừng, nướng sa tế hoặc xào rau củ.'
    ],
    [
        'id' => 4,
        'name' => 'Cá Hồi Fillet',
        'unit' => 'kg',
        'old_price' => 620000,
        'price' => 499000,
        'image' => 'https://images.unsplash.com/photo-1580476262798-bddd9f4b7369?auto=format&fit=crop&w=800&q=80',
        'category' => 'Hải sản đông lạnh',
        'desc' => 'Cá hồi fillet cắt miếng đẹp, phù hợp áp chảo, sashimi hoặc nấu cháo.'
    ],
    [
        'id' => 5,
        'name' => 'Ghẹ Xanh Loại 1',
        'unit' => 'kg',
        'old_price' => 450000,
        'price' => 390000,
        'image' => 'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?auto=format&fit=crop&w=800&q=80',
        'category' => 'Hải sản tươi sống',
        'desc' => 'Ghẹ xanh tươi, thịt ngọt, giao trong ngày, có thể hấp sả hoặc rang me.'
    ],
    [
        'id' => 6,
        'name' => 'Tôm Sú Biển',
        'unit' => 'kg',
        'old_price' => 520000,
        'price' => 459000,
        'image' => 'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?auto=format&fit=crop&w=800&q=80',
        'category' => 'Hải sản tươi sống',
        'desc' => 'Tôm sú biển tươi, size đều, thịt dai ngọt, phù hợp nướng muối ớt.'
    ],
];

$adminProducts = [
    ['id' => 1, 'name' => 'Tôm Hùm Bông', 'category' => 'Hải sản tươi sống', 'price' => 990000, 'stock' => 18, 'status' => 'Còn hàng', 'image' => 'https://images.unsplash.com/photo-1559737558-2f5a35f4523b?auto=format&fit=crop&w=600&q=80'],
    ['id' => 2, 'name' => 'Cua Cà Mau', 'category' => 'Hải sản tươi sống', 'price' => 550000, 'stock' => 32, 'status' => 'Còn hàng', 'image' => 'https://images.unsplash.com/photo-1625944525533-473f1a3d54e7?auto=format&fit=crop&w=600&q=80'],
    ['id' => 3, 'name' => 'Mực Lá Đại Dương', 'category' => 'Hải sản tươi sống', 'price' => 350000, 'stock' => 24, 'status' => 'Còn hàng', 'image' => 'https://images.unsplash.com/photo-1606851091851-e8c8c0fca5ba?auto=format&fit=crop&w=600&q=80'],
    ['id' => 4, 'name' => 'Cá Hồi Fillet', 'category' => 'Hải sản đông lạnh', 'price' => 499000, 'stock' => 0, 'status' => 'Hết hàng', 'image' => 'https://images.unsplash.com/photo-1580476262798-bddd9f4b7369?auto=format&fit=crop&w=600&q=80'],
];
$orders = [
    ['code' => 'SF1001', 'customer' => 'Nguyễn Minh Anh', 'phone' => '0909 111 222', 'total' => 1450000, 'status' => 'Đang giao', 'date' => '16/05/2026'],
    ['code' => 'SF1002', 'customer' => 'Trần Hoàng Nam', 'phone' => '0912 333 444', 'total' => 550000, 'status' => 'Chờ xác nhận', 'date' => '16/05/2026'],
    ['code' => 'SF1003', 'customer' => 'Lê Thu Hà', 'phone' => '0988 555 666', 'total' => 2390000, 'status' => 'Hoàn tất', 'date' => '15/05/2026'],
];
$customers = [
    ['name' => 'Nguyễn Minh Anh', 'email' => 'minhanh@gmail.com', 'phone' => '0909 111 222', 'orders' => 5, 'spent' => 6800000],
    ['name' => 'Trần Hoàng Nam', 'email' => 'namtran@gmail.com', 'phone' => '0912 333 444', 'orders' => 2, 'spent' => 1450000],
    ['name' => 'Lê Thu Hà', 'email' => 'hathu@gmail.com', 'phone' => '0988 555 666', 'orders' => 8, 'spent' => 12300000],
];

function priceFormat($price)
{
    return number_format($price, 0, ',', '.') . 'đ';
}

function getProductById($products, $id)
{
    foreach ($products as $product) {
        if ($product['id'] == $id) return $product;
    }
    return $products[0];
}
