<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>

<style>
:root {
    --ad-primary: rgb(19, 103, 104);
    --ad-dark: #1f2d3d;
    --ad-bg: #f4f6f9;
}

/* BODY */
body.ad-body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: var(--ad-bg);
}

/* HEADER */
.ad-header {
    height: 60px;
    background: var(--ad-primary);
    color: #fff;
    display: flex;
    align-items: center;
    padding: 0 20px;
    font-weight: 600;
}

/* SIDEBAR */
.ad-sidebar {
    width: 220px;
    height: 100vh;
    background: var(--ad-dark);
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 60px;
}

.ad-sidebar a {
    display: block;
    color: #c2c7d0;
    padding: 15px 20px;
    text-decoration: none;
    transition: 0.3s;
}

.ad-sidebar a:hover {
    background: var(--ad-primary);
    color: #fff;
}

/* MAIN */
.ad-main {
    margin-left: 220px;
    padding: 20px;
}

/* STATS */
.ad-stats {
    display: grid;
    grid-template-columns: repeat(4,1fr);
    gap: 20px;
}

.ad-card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    transition: 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.ad-card:hover {
    transform: translateY(-5px);
}

.ad-card h3 {
    margin: 0;
    color: var(--ad-primary);
    font-size: 24px;
}

.ad-card p {
    color: #666;
}

/* TABLE */
.ad-table-box {
    margin-top: 30px;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
}

.ad-title {
    color: var(--ad-primary);
    font-weight: 600;
    margin-bottom: 15px;
}

.ad-table {
    width: 100%;
    border-collapse: collapse;
}

.ad-table th,
.ad-table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}

.ad-table th {
    background: #f9f9f9;
}

/* BADGE */
.ad-badge {
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
}

.ad-success {
    background: #d4edda;
    color: #155724;
}

.ad-danger {
    background: #f8d7da;
    color: #721c24;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .ad-stats {
        grid-template-columns: repeat(2,1fr);
    }
}

@media (max-width: 600px) {
    .ad-sidebar {
        display: none;
    }

    .ad-main {
        margin-left: 0;
    }

    .ad-stats {
        grid-template-columns: 1fr;
    }
}
</style>
</head>

<body class="ad-body">

<!-- HEADER -->
<div class="ad-header">
    ADMIN DASHBOARD
</div>

<!-- SIDEBAR -->
<div class="ad-sidebar">
    <a href="#">Dashboard</a>
    <a href="#"> Người dùng</a>
    <a href="#"> Sản phẩm</a>
    <a href="#"> Đơn hàng</a>
    <a href="#"> Cài đặt</a>
</div>

<!-- MAIN -->
<div class="ad-main">

    <!-- STATS -->
    <div class="ad-stats">
        <div class="ad-card">
            <h3>120</h3>
            <p>Người dùng</p>
        </div>
        <div class="ad-card">
            <h3>45</h3>
            <p>Sản phẩm</p>
        </div>
        <div class="ad-card">
            <h3>30</h3>
            <p>Đơn hàng</p>
        </div>
        <div class="ad-card">
            <h3>12tr</h3>
            <p>Doanh thu</p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="ad-table-box">
        <div class="ad-title">Đơn hàng gần đây</div>

        <table class="ad-table">
            <tr>
                <th>ID</th>
                <th>Khách</th>
                <th>Trạng thái</th>
            </tr>

            <tr>
                <td>#001</td>
                <td>Nguyễn Văn A</td>
                <td><span class="ad-badge ad-success">Hoàn thành</span></td>
            </tr>

            <tr>
                <td>#002</td>
                <td>Trần B</td>
                <td><span class="ad-badge ad-danger">Huỷ</span></td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>