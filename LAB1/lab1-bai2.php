<?php

session_start();


if (!isset($_SESSION['products'])) {

    $_SESSION['products'] = [
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
    ];
}



if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $newProduct = [
        "id" => count($_SESSION['products']) + 1,
        "name" => $name,
        "price" => $price,
        "image" => $image
    ];

    $_SESSION['products'][] = $newProduct;
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>

  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        body{
            background: #f5f5f5;
        }

        .card img{
            height: 250px;
            object-fit: cover;
        }

    </style>

</head>

<body>

<div class="container py-5">

  
    <div class="card shadow border-0 rounded-4 mb-5">

        <div class="card-body p-4">

            <h2 class="mb-4 text-primary fw-bold">
                <i class="fa-solid fa-plus"></i>
                Thêm sản phẩm
            </h2>

            <form action="" method="POST">

                <div class="mb-3">
                    <label class="form-label">
                        Tên sản phẩm
                    </label>

                    <input 
                        type="text"
                        name="name"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Giá sản phẩm
                    </label>

                    <input 
                        type="number"
                        name="price"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Link ảnh
                    </label>

                    <input 
                        type="text"
                        name="image"
                        class="form-control"
                        required
                    >
                </div>

                <button class="btn btn-primary">
                    <i class="fa-solid fa-paper-plane"></i>
                    Gửi đi
                </button>

            </form>

        </div>

    </div>

   
    <div class="row g-4">

        <?php foreach($_SESSION['products'] as $pro): ?>

            <div class="col-md-4">

                <div class="card border-0 shadow rounded-4 overflow-hidden h-100">

                    <img src="<?= $pro['image'] ?>" class="card-img-top">

                    <div class="card-body">

                        <h4 class="fw-bold">
                            <?= $pro['name'] ?>
                        </h4>

                        <p class="text-danger fw-bold fs-4">
                            <?= number_format($pro['price']) ?>đ
                        </p>

                        <button class="btn btn-primary w-100 rounded-pill">
                            <i class="fa-solid fa-cart-shopping"></i>
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