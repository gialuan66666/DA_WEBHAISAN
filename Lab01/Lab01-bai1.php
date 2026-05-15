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
        "name" => "Sứ Mệnh Hail Mary",
        "price" => 136000,
        "image" => "https://cdn1.fahasa.com/media/catalog/product/b/_/b_a-1_7_12.jpg"
    ],
    [
        "id" => 3,
        "name" => "Người Đàn Ông Mang Tên OVE",
        "price" => 115200,
        "image" => "https://cdn1.fahasa.com/media/catalog/product/8/9/8934974182375.jpg"
    ],
];
?>

<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Shop Sách Online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 40px;
            color: #d63384;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-6px);
        }

        .card img {
            height: 320px;
            object-fit: cover;
        }

        .book-name {
            font-size: 18px;
            font-weight: bold;
            min-height: 55px;
        }

        .price {
            color: red;
            font-size: 20px;
            font-weight: bold;
        }

        .btn-buy {
            background: #d63384;
            border: none;
            border-radius: 10px;
            padding: 10px;
            transition: 0.3s;
        }

        .btn-buy:hover {
            background: #b0256b;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <h2 class="title">
            SHOP SÁCH ONLINE
        </h2>

        <div class="row">

            <?php foreach ($products as $pro): ?>

                <div class="col-md-4 mb-4">

                    <div class="card shadow-sm h-100">

                        <img src="<?= $pro['image'] ?>" class="card-img-top">

                        <div class="card-body d-flex flex-column">

                            <h5 class="book-name">
                                <?= $pro['name'] ?>
                            </h5>

                            <p class="price mt-auto">
                                <?= number_format($pro['price']) ?> VNĐ
                            </p>

                            <button class="btn btn-buy text-white w-100">
                                Mua ngay
                            </button>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</body>

</html>