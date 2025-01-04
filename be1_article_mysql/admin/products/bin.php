<?php
require_once '../../config/database.php';
$productModel = new Product();
if (isset($_POST['btn-delete'])) {
    $productModel->delete($_POST['btn-delete']);
}
if (isset($_POST['btn-restore'])) {
    $productModel->restore($_POST['btn-restore']);
}
if (isset($_POST['btn-empty'])) {
    $productModel->deleteAll($_POST['id-delete']);
}

$products = $productModel->allBin();

// Gọi template
$template = new Template();
$data = [
    'slotadmin' => $template->renderadmin('bin-form', ['products' => $products])
];

$template->viewadmin('adminlayout', $data);

            
?>

