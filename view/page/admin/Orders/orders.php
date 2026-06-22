<?php
$pageTitle = 'Quản lý đơn hàng';

require_once './controllers/admin/OrderController.php';

$orderController = new OrderController();
$orders = $orderController->getAdminOrders();

require_once './view/layouts/admin/header.php';
require_once './component/notifi.php';
?>

<div class="panel">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Danh sách đơn hàng</h5>
        <!-- <button class="btn btn-blue rounded-pill">Xuất Excel</button> -->
    </div>

    <div class="table-responsive">

        <table class="table">

            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>SĐT</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($orders)): ?>

                    <?php foreach ($orders as $o): ?>

                        <tr>

                            <td class="fw-bold">
                                #DH<?= str_pad(((int)$o['id'] % 100), 2, '0', STR_PAD_LEFT) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($o['customer_name'] ?? 'Chưa có') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($o['customer_phone'] ?? 'Chưa có') ?>
                            </td>

                            <td class="text-danger fw-bold">
                                <?= number_format($o['total'] ?? 0) ?>đ
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
                                <?= htmlspecialchars($o['created_at'] ?? '') ?>
                            </td>

                            <td class="text-end">
                                <a href="/admin/orders-detail?id=<?= htmlspecialchars($o['id']) ?>"
                                    class="btn btn-sm btn-outline-primary rounded-pill">
                                    Chi tiết
                                </a>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="7" class="text-center">
                            Chưa có đơn hàng
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php require_once './view/layouts/admin/footer.php'; ?>