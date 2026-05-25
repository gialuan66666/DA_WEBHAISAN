<?php

require_once './config/database.php';
require_once './models/productsModels.php';

class ProductController
{
    private ProductsModels $productModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->productModel = new ProductsModels($db);
    }

    public function getAdminProducts(): array
    {
        return $this->productModel->getAllProducts();
    }
}