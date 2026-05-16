<?php
$pageTitle = $pageTitle ?? 'Admin SeaFresh';
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
function activeAdmin($path, $currentPath)
{
  return $currentPath === $path ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/assets/admin/css/admin.css">
</head>

<body>
  <div class="admin-wrapper">
    <aside class="sidebar">
      <a href="/admin/dashboard" class="brand text-decoration-none">
        <span class="brand-icon"><i class="fa-solid fa-fish"></i></span>
        <span>
          <h4>SeaFresh</h4><small>Admin Panel</small>
        </span>
      </a>
      <div class="menu-title">Tổng quan</div>
      <a class="side-link <?= activeAdmin('/admin', $currentPath) ?>" href="/admin/dashboard"><i class="fa-solid fa-chart-line"></i>Dashboard</a>
      <div class="menu-title">Quản lý</div>
      <a class="side-link <?= activeAdmin('/admin/products', $currentPath) ?>" href="/admin/products"><i class="fa-solid fa-box"></i>Sản phẩm</a>
      <a class="side-link <?= activeAdmin('/admin/categories', $currentPath) ?>" href="/admin/categories"><i class="fa-solid fa-layer-group"></i>Danh mục</a>
      <a class="side-link <?= activeAdmin('/admin/orders', $currentPath) ?>" href="/admin/orders"><i class="fa-solid fa-receipt"></i>Đơn hàng</a>
      <a class="side-link <?= activeAdmin('/admin/users', $currentPath) ?>" href="/admin/users"><i class="fa-solid fa-users"></i>Khách hàng</a>
      <div class="menu-title">Hệ thống</div>
      <a class="side-link" href="/"><i class="fa-solid fa-store"></i>Về client</a>
    </aside>
    <main class="main">
      <div class="topbar">
        <div class="d-flex align-items-center gap-3">
          <button class="btn btn-blue mobile-toggle"><i class="fa-solid fa-bars"></i></button>
          <div>
            <h3><?= htmlspecialchars($pageTitle) ?></h3><small class="text-muted">Quản trị website bán hải sản</small>
          </div>
        </div>
        <div class="d-flex align-items-center gap-3">
          <input class="form-control search" placeholder="Tìm kiếm nhanh...">
        </div>
      </div>