<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include_once "data.php";
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
        include "view/layouts/header.php";
        include "view/page/client/home.php";
        include "view/layouts/footer.php";
        break;

    case 'about':
        include "view/layouts/header.php";
        include "view/page/client/about.php";
        include "view/layouts/footer.php";
        break;

    case 'contact':
        include "view/layouts/header.php";
        include "view/page/client/contact.php";
        include "view/layouts/footer.php";
        break;

    case 'product':
        include "view/layouts/header.php";
        include "view/page/client/product.php";
        include "view/layouts/footer.php";
        break;
    case 'menu':
        include "view/layouts/header.php";
        include "view/page/client/menu.php";
        include "view/layouts/footer.php";
        break;
    case 'productdetail':
        include "view/layouts/header.php";
        include "view/page/client/productDetail.php";
        include "view/layouts/footer.php";
        break;
    case 'cart':
        include "view/function/cart.php";
        include "view/layouts/header.php";
        include "view/page/client/cart.php";
        include "view/layouts/footer.php";
        break;
    case 'login':
        include "view/layouts/header.php";
        include "view/page/client/login.php";
        include "view/layouts/footer.php";
        break;
    case 'register':
        include "view/layouts/header.php";
        include "view/page/client/register.php";
        include "view/layouts/footer.php";
        break;
    case 'profile':
        include "view/layouts/header.php";
        include "view/page/client/profile.php";
        include "view/layouts/footer.php";
        break;
    case 'order':
        include "view/layouts/header.php";
        include "view/page/client/order.php";
        include "view/layouts/footer.php";
        break;
    case 'order-success':
        include "view/layouts/header.php";
        include "view/page/client/order-success.php";
        include "view/layouts/footer.php";
        break;
    
    case 'admin':
        include "view/page/admin/home.php";
        break;
    default:
        echo "<h1>404</h1>";
}
