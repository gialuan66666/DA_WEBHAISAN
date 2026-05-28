<?php
require_once __DIR__ . '/Controller/Controller.php';
$controller = new Controller();
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'product':
        $controller->product();
        break;
    default:
        $controller->home();
        break;
}
