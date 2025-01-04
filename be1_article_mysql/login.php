<?php
require_once 'config/database.php';
$userModel = new User();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $userModel->login($_POST['username'], $_POST['password']);
    if($user) {
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];
     

        header('Location: http://localhost/be1_article_mysql/');
    }
    else {
        $_SESSION['notification'] = 'Sai username hoặc passsword';
    }
}

$template = new Template();
$data = [
    'slotadmin' => $template->render('login-form', [])
];

$template->view('adminlayout', $data);