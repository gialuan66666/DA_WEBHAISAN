<?php
require_once __DIR__ . '/../models/ProductModel.php';
class AdminController
{
    public function dashboard()
    {
        include __DIR__ . '/../views/admin/dashboard.php';
    }

    public function products()
    {
        $model = new ProductModel();
        $products = $model->getAll();
        include __DIR__ . '/../views/admin/products.php';
    }
}
