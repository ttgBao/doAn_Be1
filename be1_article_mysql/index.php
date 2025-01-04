<?php 
require_once 'config/database.php';
$productModel = new Product();
$categoryModel = new Category();
$categories = $categoryModel->all();
$products = $productModel->home();
$producthot= $productModel->articlesHot();
$recentProducts = [];
if (isset($_COOKIE['recentView'])) {
    $recentView = json_decode($_COOKIE['recentView']);
    // $recentView = explode(',', $_COOKIE['recentView']);
    $recentProducts = $productModel->findIds($recentView);
}

$template = new Template();
$data = [
    'slot' => $template->render('home-products-list', ['categories' => $categories, 'productModel' => $productModel,  'products' => $products, 'producthot' => $producthot, 'recentProducts' => $recentProducts ])
];

$template->view('layout', $data);
?> 
