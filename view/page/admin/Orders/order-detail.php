<?php
$pageTitle = 'Chi tiết đơn hàng';

require_once './controllers/admin/OrderController.php';

$id = (int)($_GET['id'] ?? 0);

$orderController = new OrderController();
$data = $orderController->getOrderDetail($id);

$order = $data['order'];
$items = $data['items'];

require_once './view/layouts/admin/header.php';
require_once './component/notifi.php';
?>

<?php if (empty($order)): ?>

    <div class="panel">
        <h5 class="fw-bold mb-0">Không tìm thấy đơn hàng</h5>
    </div>

<?php else: ?>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="panel">
                <h5 class="fw-bold mb-3">
                    Đơn hàng #<?= htmlspecialchars($order['id']) ?>
                </h5>

                <table class="table">
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($item['product_name']) ?>
                                x<?= htmlspecialchars($item['quantity']) ?>
                            </td>

                            <td class="text-end">
                                <?= number_format($item['total']) ?>đ
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td>Tạm tính</td>
                        <td class="text-end">
                            <?= number_format($order['subtotal'] ?? 0) ?>đ
                        </td>
                    </tr>

                    <tr>
                        <td>Giảm giá</td>
                        <td class="text-end">
                            <?= number_format($order['discount'] ?? 0) ?>đ
                        </td>
                    </tr>

                    <tr>
                        <td>Phí vận chuyển</td>
                        <td class="text-end">
                            <?= number_format($order['shipping_fee'] ?? 0) ?>đ
                        </td>
                    </tr>

                    <tr>
                        <th>Tổng cộng</th>
                        <th class="text-end text-danger">
                            <?= number_format($order['total']) ?>đ
                        </th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel">
                <h5 class="fw-bold mb-3">Thông tin khách</h5>

                <p><b><?= htmlspecialchars($order['customer_name']) ?></b></p>
                <p><?= htmlspecialchars($order['customer_phone']) ?></p>
                <p><?= htmlspecialchars($order['customer_address']) ?></p>
                <form action="/admin/orders/update-status" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']) ?>">

                    <select name="order_status" class="form-select mb-3">
                        <option value="pending" <?= $order['order_status'] === 'pending' ? 'selected' : '' ?>>
                            Chờ xác nhận
                        </option>

                        <option value="confirmed" <?= $order['order_status'] === 'confirmed' ? 'selected' : '' ?>>
                            Đã xác nhận
                        </option>

                        <option value="shipping" <?= $order['order_status'] === 'shipping' ? 'selected' : '' ?>>
                            Đang giao
                        </option>

                        <option value="completed" <?= $order['order_status'] === 'completed' ? 'selected' : '' ?>>
                            Hoàn tất
                        </option>

                        <option value="cancelled" <?= $order['order_status'] === 'cancelled' ? 'selected' : '' ?>>
                            Đã hủy
                        </option>
                    </select>

                    <button class="btn btn-blue w-100 rounded-pill">
                        Cập nhật
                    </button>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php require_once './view/layouts/admin/footer.php'; ?>