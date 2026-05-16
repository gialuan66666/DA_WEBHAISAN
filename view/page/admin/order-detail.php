<?php $pageTitle = 'Chi tiết đơn hàng';
require_once './view/layouts/admin/header.php'; ?>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="panel">
            <h5 class="fw-bold mb-3">Đơn hàng #SF1001</h5>
            <table class="table">
                <tr>
                    <td>Tôm Hùm Bông x1</td>
                    <td class="text-end">990.000đ</td>
                </tr>
                <tr>
                    <td>Cua Cà Mau x1</td>
                    <td class="text-end">550.000đ</td>
                </tr>
                <tr>
                    <th>Tổng cộng</th>
                    <th class="text-end text-danger">1.540.000đ</th>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel">
            <h5 class="fw-bold mb-3">Thông tin khách</h5>
            <p><b>Nguyễn Minh Anh</b></p>
            <p>0909 111 222</p>
            <p>Quận Ninh Kiều, Cần Thơ</p><select class="form-select mb-3">
                <option>Đang giao</option>
                <option>Hoàn tất</option>
                <option>Đã hủy</option>
            </select><button class="btn btn-blue w-100 rounded-pill">Cập nhật</button>
        </div>
    </div>
</div>
<?php require_once './view/layouts/admin/footer.php'; ?>