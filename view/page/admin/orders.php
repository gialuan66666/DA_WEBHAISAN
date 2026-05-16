<?php $pageTitle = 'Quản lý đơn hàng';
require_once './data/data.php';
require_once './view/layouts/admin/header.php'; ?>
<div class="panel">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Danh sách đơn hàng</h5><button class="btn btn-blue rounded-pill">Xuất Excel</button>
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
            <tbody><?php foreach ($orders as $o): ?><tr>
                        <td class="fw-bold"><?= $o['code'] ?></td>
                        <td><?= $o['customer'] ?></td>
                        <td><?= $o['phone'] ?></td>
                        <td class="text-danger fw-bold"><?= number_format($o['total']) ?>đ</td>
                        <td><span class="badge-soft"><?= $o['status'] ?></span></td>
                        <td><?= $o['date'] ?></td>
                        <td class="text-end"><a href="/admin/order-detail" class="btn btn-sm btn-outline-primary rounded-pill">Chi tiết</a></td>
                    </tr><?php endforeach; ?></tbody>
        </table>
    </div>
</div>
<?php require_once './view/layouts/admin/footer.php'; ?>