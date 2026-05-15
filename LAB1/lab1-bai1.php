<?php

$products = [
    [
        "id" => 1,
        "name" => "Hồ Điệp Và Kình Ngư",
        "price" => 104000,
        "image" => "https://cdn1.fahasa.com/media/catalog/product/b/i/bia-2d_ho-diep-va-kinh-ngu_17307.jpg"
    ],
    [
        "id" => 2,
        "name" => "Sứ Mệnh Hail Mary - Project Hail Mary",
        "price" => 136000,
        "image" => "https://cdn1.fahasa.com/media/catalog/product/b/_/b_a-1_7_12.jpg"
    ],
    [
        "id" => 3,
        "name" => "Người Đàn Ông Mang Tên OVE (Tái Bản)",
        "price" => 115200,
        "image" => "https://cdn1.fahasa.com/media/catalog/product/8/9/8934974182375.jpg"
    ],
];

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body{
            background: #f5f5f5;
        }

        .card img{
            height: 320px;
            object-fit: cover;
        }

        .card{
            transition: 0.3s;
        }

        .card:hover{
            transform: translateY(-5px);
        }

        .price{
            color: red;
            font-size: 22px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <div class="row g-4">

        <?php foreach($products as $pro): ?>

            <div class="col-md-4">

                <div class="card border-0 shadow h-100 rounded-4 overflow-hidden">

                    <img src="<?= $pro['image'] ?>" class="card-img-top">

                    <div class="card-body d-flex flex-column">

                        <h4 class="fw-bold">
                            <?= $pro['name'] ?>
                        </h4>

                        <p class="price">
                            <?= number_format($pro['price']) ?>đ
                        </p>

                        <div class="mt-auto">

                            <button class="btn btn-primary w-100 rounded-pill">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Mua ngay
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>