<?php
require_once 'config/database.php';
$id = $_GET['id'];
$productModel = new Product();
$product = $productModel->findCategoryname($id);

$recentView = [];
// Nếu đã xem sp trước đó
if (isset($_COOKIE['recentView'])) {
    $recentView = json_decode($_COOKIE['recentView']);
    // $recentView = explode(',', $_COOKIE['recentView']);

    if (in_array($id, $recentView) === true) {
        // Lấy phần tử trùng ra sau đó reset lại thứ tự phần tử của mảng
        $recentView = array_values(array_diff($recentView, [$id]));
    }
    // Trùng hay không thì vẫn thêm phần tử vào cuối, giữ tối đa 5 phần tử
    if (count($recentView) === 5) {
        array_shift($recentView);
    }
    array_push($recentView, $id);
}
// Chưa xem
else {
    array_push($recentView, $id);
}

setcookie('recentView', json_encode($recentView), time() + 3600 * 24);
// setcookie('recentView', implode(',', $recentView), time() + 3600 * 24);


$commentModel = new Comment();
if(!empty($_POST['commentContent'])) {
    $commentModel->add($_POST['commentContent'], $id, $_SESSION['user_id']);
}

$comments = $commentModel->find($id);


// Gọi template
$template = new Template();
$data = [
    'slot' => $template->render('product-detail', ['product' => $product, 'comments' => $comments])
];

$template->view('layout', $data);
