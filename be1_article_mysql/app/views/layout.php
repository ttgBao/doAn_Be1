<?php
$categoryModel = new Category();
$categories = $categoryModel->all();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo thể thao</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> 

    <link rel="stylesheet" href="e.css">
</head>

<body>

    <header id="header">
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <img src="public/images/logo.png" alt="">
                        <h1 class="text">
                            TRANG THÔNG TIN KIẾN THỨC
                            <br>VÀ KỸ NĂNG DÀNH CHO CHA MẸ
                        </h1>

                </a>
            </div>
			
            <div class="right">
                <ul class="link">
                     <li><a href="articles-create.php">Viết Bài</a></li>
                    <?php
                    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) :
                    ?>
                        <li class="">
                            Xin chào <?php echo $_SESSION['username'] ?>
                        </li>
                        <li class="">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php
                    else :
                    ?>
                        <li class="">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li><a href="login.php">Register</a></li>
                    <?php
                    endif;
                    ?>
                  
	                
	                
                </ul>
                <div class="search">
                    <div class="form-search">
                        <form class="d-flex" role="search" action="search.php" method="get">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
                            <a id="btn-search" class="fa" href="javascript:;"></a>
                        </form>
                        
                    </div>
                </div>
            
                
            </div>
        <span class="open-menu"><span></span></span></div>
        <!-- Google Ads header end -->

    </header>

    <nav id="nav" class="" style="top: 0px;">
        <div class="container">
            <a href="/" class="home-link">
                <span class="fa"></span>
            </a>
            <ul class="menu">
            <?php foreach ($categories as $category): ?>
                <li>
                    <a href="category.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                </li>
                 <?php endforeach; ?>
                  
            </ul>
        </div>
    </nav>
    
    <?php
    if(!empty($slot)) {
        echo $slot;
    }
    ?>    
             
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var openMenu = document.querySelector('.open-menu');  // Lấy phần tử open-menu
        var navMenu = document.querySelector('#nav ul.menu');  // Lấy menu chứa các link

        openMenu.addEventListener('click', function() {
            openMenu.classList.toggle('active');  // Thêm hoặc bỏ class active
            navMenu.style.left = navMenu.style.left === '0px' ? '100%' : '0';  // Di chuyển menu vào hoặc ra ngoài màn hình
        });
    });
</script>

</html>