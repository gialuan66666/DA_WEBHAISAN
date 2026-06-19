<?php
require_once './config/Database.php';

$database = new Database();
$conn = $database->connect();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
//CLIENT
require_once './controllers/client/CartController.php';
require_once './controllers/client/CheckoutController.php';
require_once './controllers/client/CommentController.php';


//ADMIN
require_once './controllers/admin/OrderController.php';
require_once './controllers/admin/ProductController.php';
require_once './controllers/admin/UserController.php';
require_once './controllers/client/AuthController.php';


$request = $_SERVER['REQUEST_URI'];
// Xóa query string nếu có
$request = strtok($request, '?');
// Xóa dấu /
$request = trim($request, '/');
// Nếu rỗng → home
$page = $request ?: 'home';

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function isAdmin()
{
    return isset($_SESSION['user']) && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 1;
}

if (strpos($page, 'admin') === 0 || in_array($page, ['user_edit', 'user_update', 'user_delete'])) {
    if (!isAdmin()) {
        $_SESSION['error'] = "Bạn không có quyền truy cập vào khu vực quản trị!";
        header("Location: /");
        exit;
    }
}

if (in_array($page, ['login', 'register'])) {
    if (isLoggedIn()) {
        header("Location: /");
        exit;
    }
}


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

    case 'productdetail':

        include "view/page/client/detail.php";

        break;
    case 'cart':
        $cartController = new CartController();
        $cartItems = $cartController->index();

        include "view/page/client/Cart/cart.php";

        break;

    case 'logout':
        session_unset();
        session_destroy();
        header("Location: /login");
        exit;


    case 'cart/add':

        $cartController = new CartController();
        $cartController->add();

        break;

    case 'cart/remove':
        $cartController = new CartController();
        $cartController->remove();

        break;

    case 'cart/update':
        $cartController = new CartController();
        $cartController->update();

        break;

    case 'buy-now':
        $cartController = new CartController();
        $cartController->buyNow();

        break;

    case 'checkout':
        $checkoutController = new CheckoutController();
        $checkoutItems = $checkoutController->index();

        include "view/page/client/Cart/checkout.php";

        break;

    case 'checkout/order':
        $checkoutController = new CheckoutController();
        $checkoutController->order();

        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController = new AuthController($conn);
            $authController->login();
        } else {
            include "view/page/client/Auth/login.php";
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController = new AuthController($conn);
            $authController->register();
        } else {
            include "view/page/client/Auth/register.php";
        }
        break;
    case 'admin/orders':


        include "view/page/admin/Orders/orders.php";

        break;

    case 'admin':

    case 'admin/dashboard':

        include "view/page/admin/dashboard.php";

        break;


    case 'admin/users':
        $userController = new UserController();
        $customers = $userController->index();
        include "view/page/admin/Users/users.php";
        break;

    case 'user_edit':
        $userController = new UserController();
        $user = $userController->show((int)$_GET['id']);
        include "view/page/admin/Users/Edit.php";
        break;

    case 'user_update':
        $userController = new UserController();
        $userController->update();
        break;

    case 'user_delete':
        $userController = new UserController();
        $userController->destroy();
        break;


    case 'admin/categories':
        include "view/page/admin/categories.php";
        break;


    case 'admin/products':

        include "view/page/admin/Products/products.php";

        break;

    case 'admin/products/create':
        include "view/page/admin/Products/product-create.php";
        break;

    case 'admin/products/edit':
        include "view/page/admin/Products/product-edit.php";
        break;
    case 'admin/products/delete':
        $productController = new ProductController();
        $productController->destroy();

        break;
    case 'admin/orders':
        include "view/page/admin/Orders/orders.php";
        break;

    case 'admin/orders-detail':
        include "view/page/admin/Orders/order-detail.php";
        break;

    case 'admin/orders/update-status':
        $orderController = new OrderController();
        $orderController->updateStatus();
        break;

    case 'comment':
        $controller = new CommentController($conn);
        $controller->store();
        break;
    default:
        echo "<h1>404</h1>";
}
