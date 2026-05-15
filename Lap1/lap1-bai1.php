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

<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5f5f5">

    <div class="container py-4">

        <h2 class="text-center mb-4">Danh sách sản phẩm</h2>

        <div class="row">
            <?php foreach ($products as $pro): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">

                        <img src="<?= $pro['image'] ?>"
                            class="card-img-top"
                            style="height:250px; object-fit:cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $pro['name'] ?></h5>

                            <p class="text-danger fw-bold mt-auto">
                                <?= number_format($pro['price']) ?> VNĐ
                            </p>

                            <button class="btn btn-primary w-100">
                                Mua ngay
                            </button>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>