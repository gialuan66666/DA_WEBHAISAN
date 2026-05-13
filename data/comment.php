<?php
if (!isset($_SESSION)) {
    session_start();
}

// ✅ DATA GIẢ LẬP (comment có sẵn)
$comments = [
    [
        "product_id" => 1,
        "username" => "Gia luận",
        "rating" => 5,
        "content" => "Sản phẩm rất tốt!",
        "time" => "01/01/2026 10:00"
    ],
    [
        "product_id" => 1,
        "username" => "Nguyễn Văn A",
        "rating" => 4,
        "content" => "Chất lượng ổn, giao hàng nhanh.",
        "time" => "02/01/2026 14:30"
    ],
    [
        "product_id" => 2,
        "username" => "Trần Thị B",
        "rating" => 3,
        "content" => "Sản phẩm bình thường, không như mong đợi.",
        "time" => "03/01/2026 09:15"
    ],
    [
        "product_id" => 3,
        "username" => "Lê Văn C",
        "rating" => 5,
        "content" => "Rất hài lòng với sản phẩm này!",
        "time" => "04/01/2026 16:45"
    ]
];

// ✅ SESSION COMMENT
if (!isset($_SESSION['comments'])) {
    $_SESSION['comments'] = [];
}