<?php
require_once '../../config/database.php';

if(!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] === false || $_SESSION['role_id'] != 2) {
    header('Location: http://localhost/be1_article_mysql/');
}
$productModel = new Product();
if (isset($_POST['product-id'])) {
    $productModel->bin($_POST['product-id']);
}


$products = $productModel->all();
// Gọi template
$template = new Template();
$data = [
    'slotadmin' => $template->renderadmin('home-admin-index', ['products' => $products])
];

$template->viewadmin('adminlayout', $data);
?>
