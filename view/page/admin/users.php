<?php $pageTitle = 'Quản lý khách hàng';
require_once './data/data.php';
require_once './view/layouts/admin/header.php'; ?>
<div class="panel">
    <h5 class="fw-bold mb-3">Danh sách khách hàng</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Khách hàng</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Số đơn</th>
                <th>Chi tiêu</th>
                <th></th>
            </tr>
        </thead>
        <tbody><?php foreach ($customers as $c): ?><tr>
                    <td class="fw-bold"><?= $c['name'] ?></td>
                    <td><?= $c['email'] ?></td>
                    <td><?= $c['phone'] ?></td>
                    <td><?= $c['orders'] ?></td>
                    <td class="text-danger fw-bold"><?= number_format($c['spent']) ?>đ</td>
                    <td class="text-end"><button class="btn btn-sm btn-outline-primary rounded-pill">Xem</button></td>
                </tr><?php endforeach; ?></tbody>
    </table>
</div>
<?php require_once './view/layouts/admin/footer.php'; ?>