<?php
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});

$categoryModel = new Category();
$categories = $categoryModel->all();

if (!empty($_POST['title']) && !empty($_POST['content'])  && !empty($_FILES['image']) && !empty($_POST['category-id'])  ) {
    $productModel = new Product();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category-id'];
    $author_id = $_SESSION['user_id'];
    if(!empty($_FILES['image']['name'])) {
        $uploadPath = 'public/images/' .  time() . '.' . pathinfo($_FILES['image']['name'])['extension'];
        if(is_uploaded_file($_FILES['image']['tmp_name']) && move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                 $image = $uploadPath;
                $_SESSION['alert-nofitication'] = '<div class="alert alert-success" role="alert">Gửi thành công!!</div>';
                
            
        } else {
            echo 'Error uploading file.';
        }
    } else {
        $_SESSION['alert-nofitication'] = '<div class="alert alert-success" role="alert">Gửi thành công!!</div>';
        $image ="...";
    }

    if ($productModel->userAdd($title, $content,$image,$categoryId,$author_id)){}
   

    }


// Gọi template
$template = new Template();
$data = [
    'slotadmin' => $template->render('is-approved-form', ['categories' => $categories])
];

$template->view('adminlayout', $data);
?>

