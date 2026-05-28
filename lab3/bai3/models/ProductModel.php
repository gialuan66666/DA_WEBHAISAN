<?php
class ProductModel
{
    public function getAll()
    {
        return [
            ['id' => 1, 'name' => 'Áo thể thao', 'price' => '250.000đ', 'status' => 'Đang bán'],
            ['id' => 2, 'name' => 'Giày chạy bộ', 'price' => '890.000đ', 'status' => 'Đang bán'],
            ['id' => 3, 'name' => 'Balo thể thao', 'price' => '390.000đ', 'status' => 'Đang bán'],
        ];
    }
}
