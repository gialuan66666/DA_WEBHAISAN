<?php
session_start();

if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $id = count($_SESSION['products']) + 1;

    $_SESSION['products'][] = [
        "id" => $id,
        "name" => $name,
        "price" => $price,
        "image" => $image
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Tạo form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2 class="mb-4"> Thêm sản phẩm</h2>

    <form method="POST" class="row g-3">

        <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="Tên sản phẩm" required>
        </div>

        <div class="col-md-3">
            <input type="number" name="price" class="form-control" placeholder="Giá" required>
        </div>

        <div class="col-md-4">
            <input type="text" name="image" class="form-control" placeholder="URL ảnh" required>
        </div>

        <div class="col-md-1">
            <button class="btn btn-primary w-100">Thêm</button>
        </div>

    </form>

    <hr>

    <h3>Danh sách sản phẩm</h3>

    <div class="row">
        <?php foreach($_SESSION['products'] as $pro): ?>
            <div class="col-md-4 mt-3">
                <div class="card h-100">
                    <img src="<?= $pro['image'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                    
                    <div class="card-body">
                        <h5><?= $pro['name'] ?></h5>
                        <p class="text-danger fw-bold"><?= number_format($pro['price']) ?> VNĐ</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>