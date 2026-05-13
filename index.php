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
        include "layouts/header.php";
        include "page/client/home.php";
        include "layouts/footer.php";
        break;

    case 'about':
        include "layouts/header.php";
        include "page/client/about.php";
        include "layouts/footer.php";
        break;

    case 'contact':
        include "layouts/header.php";
        include "page/client/contact.php";
        include "layouts/footer.php";
        break;

    case 'product':
        include "layouts/header.php";
        include "page/client/product.php";
        include "layouts/footer.php";
        break;
    case 'menu':
        include "layouts/header.php";
        include "page/client/menu.php";
        include "layouts/footer.php";
        break;
    case 'productdetail':
        include "layouts/header.php";
        include "page/client/productDetail.php";
        include "layouts/footer.php";
        break;
    case 'cart':
        include "funtion/cart.php";
        include "layouts/header.php";
        include "page/client/cart.php";
        include "layouts/footer.php";
        break;
    case 'login':
        include "layouts/header.php";
        include "page/client/login.php";
        include "layouts/footer.php";
        break;
    case 'register':
        include "layouts/header.php";
        include "page/client/register.php";
        include "layouts/footer.php";
        break;
    case 'profile':
        include "layouts/header.php";
        include "page/client/profile.php";
        include "layouts/footer.php";
        break;
    case 'order':
        include "layouts/header.php";
        include "page/client/order.php";
        include "layouts/footer.php";
        break;
    case 'order-success':
        include "layouts/header.php";
        include "page/client/order-success.php";
        include "layouts/footer.php";
        break;

    default:
        echo "<h1>404</h1>";
}
