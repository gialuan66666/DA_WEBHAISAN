<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();


require_once './controllers/admin/ProductController.php';
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


        include "view/page/admin/orders.php";

        break;

    case 'admin':

    case 'admin/dashboard':

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

        include "view/page/admin/products.php";

        break;

    case 'admin/products/create':
        include "view/page/admin/product-create.php";
        break;

    case 'admin/products/edit':
        include "view/page/admin/product-edit.php";
        break;
    case 'admin/products/delete':

        

        $productController = new ProductController();
        $productController->destroy();

        break;
    default:
        echo "<h1>404</h1>";
}
