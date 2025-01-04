
<?php
require_once 'config/database.php';

// Khởi tạo biến thông báo
$nofitication = '';

if (isset($_POST['send_email'])) {
    $email = $_POST['email'];

    // Kết nối tới database
    $userModel = new User();

    // Kiểm tra email có tồn tại không
    $checkEmail = $userModel->checkEmail($email);

    if ($checkEmail) {
        // Tạo token reset mật khẩu
        $token = bin2hex(random_bytes(32)); // Tạo token bảo mật
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token hết hạn sau 1 giờ

        // Lưu token và thời gian hết hạn vào database
        $userModel->saveResetToken($email, $token, $expires_at);

        // Hiển thị liên kết reset mật khẩu
        $nofitication = "Click vào liên kết sau để đặt lại mật khẩu của bạn: ";
        $nofitication .= "<a href='http://localhost/be1_article_mysql/quenmatkhau.php?token=$token'>Reset mật khẩu</a>";
    } else {
        $nofitication = "Email không tồn tại trong hệ thống.";
    }
}

$template = new Template();
$data = [
    'slotadmin' => $template->render('checkMail-form', [])
];

$template->view('adminlayout', $data);