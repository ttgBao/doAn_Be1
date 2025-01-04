<?php
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
        if(isset($_POST['product-id']) && isset($_POST['guibinhluan'])) {

            $ids = $_POST['product-id'];
     
            $comments = $productModel->showConmment($ids);
        }

if ($comments) {
    foreach ($comments as $comment) {
        echo '<p>' . htmlspecialchars($comment['content']) . '</p>';
    }
} else {
    echo '<p>Chưa có bình luận nào.</p>';
}

    
    ?>
<form action="binhluan.php" method="post">
    <input type="text" name ="name" value ="<?php echo $_SESSION['username'] ?>">
    <input type="hidden" name="product-id" value ="<?php echo $product["id"] ?>">
    <textarea name="content" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="Gửi bình luận" name="guibinhluan">


</form>


<?php } else {
    echo "vui lòng đăng nhập";  
} ?>