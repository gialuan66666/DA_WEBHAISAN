<?php
require_once __DIR__ . '/../models/ProductModel.php';
class HomeController
{
    public function home()
    {
        include __DIR__ . '/../views/client/home.php';
    }

    public function products()
    {
        $model = new ProductModel();
        $products = $model->getAll();
        include __DIR__ . '/../views/client/products.php';
    }
}
