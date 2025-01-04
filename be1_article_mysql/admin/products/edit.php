<?php
require_once '../../config/database.php';

$categoryModel = new Category();
$categories = $categoryModel->all();

$id = $_GET['id'];
$productModel = new Product();
$product = $productModel->find($id);



if (!empty($_POST['title']) && !empty($_POST['content'])  && !empty($_POST['category-id'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category-id'];
    // Nếu có file được upload
    if (!empty($_FILES['imagefile']['name'])) {
        $uploadPath = '../../public/images/' . time() . '.' . pathinfo($_FILES['imagefile']['name'], PATHINFO_EXTENSION);
        if (is_uploaded_file($_FILES['imagefile']['tmp_name']) && move_uploaded_file($_FILES['imagefile']['tmp_name'], $uploadPath)) {
            $image = $uploadPath; // Gán đường dẫn file ảnh mới
        } else {
            echo 'Error uploading file.';   
            exit;
        }
    } else {
        // Không upload file mới, giữ lại ảnh hiện tại
        $image = $_POST['image'];
    }

    // Cập nhật sản phẩm
    if ($productModel->update($title, $content, $image, $id, $categoryId))
        header("Location: http://localhost/be1_article_mysql/admin/products/");
     
    
}

// Gọi template
$template = new Template();
$data = [
    'slotadmin' => $template->renderadmin('edit-form', ['product' => $product ,'categories' => $categories])
];

$template->viewadmin('adminlayout', $data);

            
        

?>

