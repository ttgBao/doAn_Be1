<?php 
require_once 'config/database.php';
    $id = $_GET['id'];
    $productModel = new Product();
    $product = $productModel->find($id);
    $comments = null;

    $template = new Template();
    $data = [
        'slot' => $template->render('binhluan-form', ['product' => $product])
    ];
    
    $template->view('layout', $data);

?>


