<?php 
   if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) { 
?>
<div class="container mt-5 p-4 rounded shadow bg-light">
    <h1 class="text-center text-success mb-4">Báo Thể Thao</h1>

    <?php 
        if (!empty($_SESSION['alert-nofitication'])) {
            echo "<div class='alert alert-info text-center p-2'>" . $_SESSION['alert-nofitication'] . "</div>";
        }
    ?>

    <form action="articles-create.php" method="post" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="title" class="form-label fw-bold text-primary">Nhập Tiêu Đề</label>
            <input type="text" class="form-control shadow-sm p-3 rounded" id="title" name="title" placeholder="Nhập tiêu đề bài viết tại đây...">
        </div>

        <div class="mb-4">
            <label for="content" class="form-label fw-bold text-primary">Nội Dung</label>
            <textarea class="form-control shadow-sm p-3 rounded" id="content" name="content" rows="6" placeholder="Hãy viết nội dung bài báo của bạn..."></textarea>
            <small class="text-muted">
                <strong>Mẹo định dạng nội dung:</strong> Bạn có thể sử dụng các thẻ HTML sau:
                <ul class="mt-2">
                    <li><code>&lt;br&gt;</code>: Xuống dòng.</li>
                    <li><code>&lt;b&gt;Nội dung bạn muốn ghi...&lt;/b&gt;</code>: Làm chữ in đậm.</li>
                    <li><code>&lt;i&gt;Nội dung bạn muốn ghi...&lt;/i&gt;</code>: Làm chữ nghiêng.</li>
                    <li><code>&lt;ul&gt;&lt;li&gt;Nội dung bạn muốn ghi...&lt;/li&gt;&lt;/ul&gt;</code>: Tạo danh sách.</li>
                </ul>
            </small>
        </div>

        <div class="mb-4">
            <label for="image" class="form-label fw-bold text-primary">Chọn Hình Ảnh</label>
            <input type="file" class="form-control shadow-sm p-3 rounded" id="image" name="image">
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold text-primary">Danh Mục</label>
            <div class="btn-group d-flex flex-wrap" role="group">
                <?php foreach ($categories as $category): ?>
                    <input type="checkbox" class="btn-check" id="category-<?php echo $category['id']; ?>" autocomplete="off" value="<?php echo $category['id']; ?>" name="category-id[]">
                    <label class="btn btn-outline-success shadow-sm m-1" for="category-<?php echo $category['id']; ?>">
                        <?php echo $category['name']; ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg px-5 py-2 shadow">Gửi Bài Viết</button>
        </div>
    </form>
</div>
<?php 
   } else {
       header("Location: login.php");
   } 
?>
