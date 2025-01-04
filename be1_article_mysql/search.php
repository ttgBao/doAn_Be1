<?php
require_once 'config/database.php';
$q = '';
if (isset($_GET['q'])) {
    $q = $_GET['q'];
}

$productModel = new Product();
$products = $productModel->findByKeyWord($q);

$categoryModel = new Category();
$categories = $categoryModel->all();

// Gọi template
$template = new Template();
$data = [
    'slot' => $template->render('search-form', ['products' => $products, 'categories' => $categories, 'q' => $q])
];

$template->view('layout', $data);
?>
