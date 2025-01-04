<?php
require_once 'config/database.php';
$userModel = new User();
if (isset($_POST['username']) && isset($_POST['password'])) {
    if($userModel->register($_POST['username'], $_POST['password'])) {
        header('Location: http://localhost/be1_article_mysql/login.php');
    }
}

$template = new Template();
$data = [
    'slotadmin' => $template->render('login-form', [])
];

$template->view('adminlayout', $data);
?>
