<?php
require_once 'config/database.php';

$nofitication = '';
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $userModel = new User();

    // Kiểm tra token có hợp lệ không
    $user = $userModel->checkResetToken($token);

    if ($user) {
        if (isset($_POST['reset_password'])) {
            $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            // Cập nhật mật khẩu mới và xóa token
            $userModel->updatePassword($user['email'], $new_password);
            $nofitication = "Mật khẩu của bạn đã được đặt lại thành công.";
        }
    } else {
        $nofitication = "Token không hợp lệ hoặc đã hết hạn.";
    }
} else {
    $nofitication = "Không có token hợp lệ.";
}


$template = new Template();
$data = [
    'slotadmin' => $template->render('quenmatkhau-form', [])
];

$template->view('adminlayout', $data);