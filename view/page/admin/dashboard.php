<?php

$pageTitle = 'Dashboard';

$orders = $orders ?? [];
$adminProducts = $adminProducts ?? [];


require_once './view/layouts/admin/header.php';


?>

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>

            <h2>
                <?= number_format($revenue['revenue'] ?? 0) ?>đ
            </h2>

            <p>Doanh thu</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-receipt"></i>
            </div>

            <h2>
                <?= $totalOrders['total_orders'] ?? 0 ?>
            </h2>

            <p>Đơn hàng</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-box"></i>
            </div>

            <h2>
                <?= $totalProducts['total_products'] ?? 0 ?>
            </h2>

            <p>Sản phẩm</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <h2>
                <?= $totalUsers['total_users'] ?? 0 ?>
            </h2>

            <p>Khách hàng</p>
        </div>
    </div>

</div>

<div class="row g-4">

    <div class="col-lg-8">

        <div class="panel">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">
                    Đơn hàng gần đây
                </h5>

                <a href="/admin/orders"
                   class="btn btn-sm btn-blue rounded-pill">
                    Xem tất cả
                </a>
            </div>

            <div class="table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($orders as $o): ?>

                            <tr>

                                <td class="fw-bold">
                                    #DH<?= $o['id'] ?>
                                </td>

                                <td>
                                    <?= $o['customer_name'] ?>
                                </td>

                                <td>
                                    <?= number_format($o['total']) ?>đ
                                </td>

                                <td>
                                                                    <span class="badge-soft">
                                    <?php
                                    $statusText = [
                                        'pending'   => 'Chờ xác nhận',
                                        'confirmed' => 'Đã xác nhận',
                                        'shipping'  => 'Đang giao',
                                        'completed' => 'Hoàn tất',
                                        'cancelled' => 'Đã hủy'
                                    ];
                                    ?>

                                    <?= $statusText[$o['order_status']] ?? $o['order_status'] ?>
                                </span>
                                </td>

                                <td>
                                    <?= $o['created_at'] ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="panel">

            <h5 class="fw-bold mb-3">
                Sản phẩm sắp hết
            </h5>

            <?php foreach ($adminProducts as $p): ?>

                <div class="d-flex align-items-center gap-3 border-bottom py-3">

                    <img src="<?= $p['image'] ?>"
                         class="product-thumb">

                    <div>

                        <div class="fw-bold">
                            <?= $p['name'] ?>
                        </div>

                        <small class="text-muted">
                            Kho: <?= $p['quantity'] ?>
                        </small>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</div>

<?php require_once './view/layouts/admin/footer.php'; ?>