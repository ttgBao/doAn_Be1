<?php
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$productModel = new Product();
$products = $productModel->findByCategory($id);

$categoryModel = new Category();
$categories = $categoryModel->all();
// Gọi template
$template = new Template();
$data = [
    'slot' => $template->render('category-form', ['products' => $products, 'categories' => $categories])
];

$template->view('layout', $data);
?>

