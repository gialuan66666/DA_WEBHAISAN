<?php

include_once 'data.php';

$keyword = $_GET['keyword'] ?? '';
$category = $_GET['category'] ?? '';
$maxPrice = isset($_GET['price']) ? (int)$_GET['price'] : 100000;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;


$FilteredProducts = array_filter($Products, function ($item) use ($keyword, $category, $maxPrice) {

    $matchKeyword = true;
    if ($keyword !== '') {
        $matchKeyword = stripos($item['name'], $keyword) !== false;
    }

    $matchCategory = true;
    if ($category !== '') {
        $matchCategory = ($item['category_id'] == $category);
    }

    $matchPrice = ($item['price'] <= $maxPrice);

    return $matchKeyword && $matchCategory && $matchPrice;
});

$perPage = 6;

$totalProducts = count($FilteredProducts);
$totalPages = max(1, ceil($totalProducts / $perPage));

if ($page > $totalPages) $page = $totalPages;

$start = ($page - 1) * $perPage;

$FilteredProducts = array_slice($FilteredProducts, $start, $perPage);

?>