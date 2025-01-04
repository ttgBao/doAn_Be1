<?php
require_once '../../config/database.php';
$categoryModel = new Category();
$categories = $categoryModel->all();

if (!empty($_POST['title']) && !empty($_POST['content'])  && !empty($_FILES['image']) && !empty($_POST['category-id'])  ) {
    $productModel = new Product();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category-id'];
    if(!empty($_FILES['image']['name'])) {
    
        $uploadPath = '../../public/images/' .  time() . '.' . pathinfo($_FILES['image']['name'])['extension'];
        if(is_uploaded_file($_FILES['image']['tmp_name']) && move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                $image = $uploadPath;
        } else {
            echo 'Error uploading file.';   
        }
    } else {
        $image = "...";
    }
    if ($productModel->add($title, $content,$image,$categoryId)) 
    header("Location: http://localhost/be1_article_mysql/admin/products/");

}
// Gọi template
$template = new Template();
$data = [
    'slotadmin' => $template->renderadmin('add-form', ['categories' => $categories])
];

$template->viewadmin('adminlayout', $data);
?>


