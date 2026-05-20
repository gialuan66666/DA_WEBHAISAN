<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
// include_once "./data/data.php";
// 
include_once "./config/database.php";
$db = new Database();
$conn = $db->connect();


$request = $_SERVER['REQUEST_URI'];
// Xóa query string nếu có
$request = strtok($request, '?');
// Xóa dấu /
$request = trim($request, '/');
// Nếu rỗng → home
$page = $request ?: 'home';


switch ($page) {

    // CLIENT
    case 'home':

        include "view/page/client/home.php";

        break;

    case 'about':

        include "view/page/client/about.php";

        break;

    case 'contact':

        include "view/page/client/contact.php";

        break;

    case 'product':

        $sql = "SELECT * FROM products";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $products = $stmt->fetchAll();

        include "view/page/client/products.php";

        break;
    case 'checkout':

        include "view/page/client/checkout.php";

        break;
    case 'productdetail':

        include "view/page/client/detail.php";

        break;
    case 'cart':

        include "view/page/client/cart.php";

        break;
    case 'login':

        include "view/page/client/login.php";

        break;
    case 'register':

        include "view/page/client/register.php";

        break;
    case 'admin/orders':

        require_once './controllers/OrderController.php';

        $orderController = new OrderController();

        $orders = $orderController->getAllOrders();

        include "view/page/admin/orders.php";

        break;

    case 'admin':
    case 'admin/dashboard':

        require_once './controllers/DashboardController.php';

        $dashboard = new DashboardController();

        $revenue = $dashboard->getRevenue();
        $totalOrders = $dashboard->getTotalOrders();
        $totalProducts = $dashboard->getTotalProducts();
        $totalUsers = $dashboard->getTotalUsers();

        $orders = $dashboard->getLatestOrders();

        $adminProducts = $dashboard->getLowStockProducts();

        include "view/page/admin/dashboard.php";

        break;


    case 'admin/users':
        include "view/page/admin/users.php";
        break;


    case 'admin/categories':
        include "view/page/admin/categories.php";
        break;

    case 'admin/users':
        include "view/page/admin/users.php";
        break;

    case 'admin/products':

        require_once './controllers/ProductController.php';

        $productController = new ProductController();

        $adminProducts = $productController->getAllProducts();

        include "view/page/admin/products.php";

        break;

    case 'admin/products/create':
        include "view/page/admin/product-create.php";
        break;

    case 'admin/products/edit':
        include "view/page/admin/product-edit.php";
        break;
    default:
        echo "<h1>404</h1>";
}
