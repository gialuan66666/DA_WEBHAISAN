<?php $pageTitle = 'Thêm sản phẩm';
require_once './view/layouts/admin/header.php'; ?>
<div class="panel">
    <form>
        <div class="row g-4">
            <div class="col-lg-8">
                <h5 class="fw-bold mb-3">Thông tin sản phẩm</h5>
                <div class="mb-3"><label class="form-label">Tên sản phẩm</label><input class="form-control" placeholder="VD: Tôm hùm bông"></div>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Danh mục</label><select class="form-select">
                            <option>Hải sản tươi sống</option>
                            <option>Hải sản đông lạnh</option>
                            <option>Đồ khô</option>
                        </select></div>
                    <div class="col-md-6"><label class="form-label">Đơn vị</label><input class="form-control" placeholder="kg / con"></div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6"><label class="form-label">Giá cũ</label><input class="form-control" type="number"></div>
                    <div class="col-md-6"><label class="form-label">Giá bán</label><input class="form-control" type="number"></div>
                </div>
                <div class="mb-3 mt-3"><label class="form-label">Mô tả</label><textarea class="form-control" rows="5"></textarea></div>
            </div>
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Ảnh & trạng thái</h5>
                <div class="mb-3"><label class="form-label">Link ảnh</label><input class="form-control" placeholder="https://..."></div>
                <div class="mb-3"><label class="form-label">Tồn kho</label><input class="form-control" type="number"></div>
                <div class="mb-4"><label class="form-label">Trạng thái</label><select class="form-select">
                        <option>Còn hàng</option>
                        <option>Hết hàng</option>
                    </select></div><button class="btn btn-blue w-100 rounded-pill">Lưu sản phẩm</button>
            </div>
        </div>
    </form>
</div>
<?php require_once './view/layouts/admin/footer.php'; ?>