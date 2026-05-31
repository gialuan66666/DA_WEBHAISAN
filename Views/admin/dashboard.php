<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 bg-dark text-white vh-100 p-3">
            <h4 class="text-center">ADMIN</h4>
            <hr>

            <a href="?page=admin" class="text-white d-block mb-3">Dashboard</a>
            <a href="?page=admin-products" class="text-white d-block mb-3">Sản phẩm</a>
            <a href="#" class="text-white d-block mb-3">Danh mục</a>
            <a href="#" class="text-white d-block mb-3">Đơn hàng</a>
        </div>

        <div class="col-md-10">

            <nav class="navbar navbar-light bg-light px-3">
                <span class="navbar-brand mb-0 h5">Trang quản trị</span>
            </nav>

            <div class="p-4">

                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white mb-3">
                            <div class="card-body">
                                <h6>Đơn hàng</h6>
                                <h3>120</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-success text-white mb-3">
                            <div class="card-body">
                                <h6>Sản phẩm</h6>
                                <h3>50</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-warning text-white mb-3">
                            <div class="card-body">
                                <h6>Khách hàng</h6>
                                <h3>30</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-danger text-white mb-3">
                            <div class="card-body">
                                <h6>Doanh thu</h6>
                                <h3>20tr</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="mt-4">Đơn hàng gần đây</h4>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>mì tôm</td>
                            <td>500.000đ</td>
                            <td><span class="badge bg-success">Đã giao</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>mì tôm</td>
                            <td>300.000đ</td>
                            <td><span class="badge bg-warning">Đang xử lý</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>