<?php
require_once '../../config/database.php';
$productModel = new Product();

$products = $productModel->allApproved();
if(isset($_POST['btn-approved'])) {
    $productModel->Approved($_POST['btn-approved']);
}
if(isset($_POST['btn-refuse'])) {
    $productModel->delete($_POST['btn-refuse']);
}
// Gọi template
$template = new Template();
$data = [
    'slotadmin' => $template->renderadmin('admin-approved', ['products' => $products])
];

$template->viewadmin('adminlayout', $data);
?>
