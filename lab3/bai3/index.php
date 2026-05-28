<?php
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/AdminController.php';

$page = $_GET['page'] ?? 'home';
$home = new HomeController();
$admin = new AdminController();

switch ($page) {
    case 'products':
        $home->products();
        break;
    case 'admin':
        $admin->dashboard();
        break;
    case 'admin-products':
        $admin->products();
        break;
    default:
        $home->home();
        break;
}
