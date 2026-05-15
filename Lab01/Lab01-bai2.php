<?php
session_start();

if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $id = count($_SESSION['books']) + 1;

    $_SESSION['books'][] = [
        "id" => $id,
        "name" => $name,
        "price" => $price,
        "image" => $image
    ];
}
?>

<!DOCTYPE html>
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
            color: #d63384;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .form-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            height: 300px;
            object-fit: cover;
        }

        .book-name {
            font-size: 18px;
            font-weight: bold;
            min-height: 50px;
        }

        .price {
            color: red;
            font-size: 20px;
            font-weight: bold;
        }

        .btn-add {
            background: #d63384;
            border: none;
        }

        .btn-add:hover {
            background: #b0256b;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <h2 class="title">
        SHOP SÁCH ONLINE
    </h2>

    <div class="form-box shadow-sm mb-5">

        <h4 class="mb-4">Thêm sách mới</h4>

        <form method="POST" class="row g-3">

            <div class="col-md-4">
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Tên sách"
                       required>
            </div>

            <div class="col-md-3">
                <input type="number"
                       name="price"
                       class="form-control"
                       placeholder="Giá sách"
                       required>
            </div>

            <div class="col-md-4">
                <input type="text"
                       name="image"
                       class="form-control"
                       placeholder="URL ảnh bìa sách"
                       required>
            </div>

            <div class="col-md-1">
                <button class="btn btn-add text-white w-100">
                    Thêm
                </button>
            </div>

        </form>

    </div>

    <div class="row">

        <?php foreach($_SESSION['books'] as $book): ?>

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100">

                    <img src="<?= $book['image'] ?>" class="card-img-top">

                    <div class="card-body d-flex flex-column">

                        <h5 class="book-name">
                            <?= $book['name'] ?>
                        </h5>

                        <p class="price mt-auto">
                            <?= number_format($book['price']) ?> VNĐ
                        </p>

                        <button class="btn btn-outline-danger w-100">
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