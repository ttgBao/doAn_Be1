<section>
    <div class="container py-4">
    <div class="row g-4">
       

    <div class="container py-4">
    <div class="row g-4">
                <?php
                foreach ($products as $product) :
                ?>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    
                   <a href="product.php?id=<?php echo $product['id'] ?>" style ="text-decoration: none;"><h4 class="card-title-home border-bottom pb-2">   <?php
                        echo (!empty($product['category_name'])) ? implode(array_map(function ($e) {
                            return $e;
                        }, explode(',', $product['category_name']))) : '';
                    ?></h4></a> 
                    <img src="public/images/<?php echo $product['image_url']; ?>" class="card-img-top mb-3 rounded" alt="Pháp luật">
                    <h5 class="card-subtitle mb-3 fw-bold border-bottom pb-2">
                        <a href="product.php?id=<?php echo $product['id'] ?>" class="body-text-title">  <?php
                                                    $title = (strlen($product['title']) > 150) ? substr($product['title'], 0, 147) . '...Xem Thêm' : $product['title'];
                                                    echo $title;
                                                    ?></a>
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="product.php?id=<?php echo $product['id'] ?>" class="text-muted text-decoration-none"><?php echo substr($product['content'], 0, 150) . '...'; ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
      endforeach;
          ?>





        
    </section>
    <section>
        <div class="container">
        <h4 style="color: red;  font-weight: 500; margin-top: 30px;"> <img src="public/images/3.png" alt="" style="width: 20px; height: 20px;"> Đang nóng trên diễn đàn</h4>
        <div class="row">
            <div class="col-md-10">
            <div class="line" style="background-color: red; width: 100%; height: 1px;"></div>
<div class="border rounded p-3 hot-slider">
    <!-- Slide 1: 6 sản phẩm đầu tiên -->
    <div class="slide">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php for ($i = 0; $i < 6; $i++) : ?>
          <div class="col">
            <div class="card" style="background-color: <?php echo ($i % 2 == 0) ? '#f8d7da' : '#d1ecf1'; ?>;">
              <div class="card-body">
                <h3 class="card-title">
                  <a class="body-text-title_hot" href="product.php?id=<?php echo $producthot[$i]['id']; ?>">
                    <?php
                    $title = (strlen($producthot[$i]['title']) > 150) ? substr($producthot[$i]['title'], 0, 147) . '...Xem Thêm' : $producthot[$i]['title'];
                    echo $title;
                    ?>
                  </a>
                </h3>
                <p class="card-text"><?php echo $producthot[$i]['username']; ?></p>
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>

    <!-- Slide 2: 4 sản phẩm còn lại -->
    <div class="slide">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php for ($i = 6; $i < count($producthot); $i++) : ?>
          <div class="col">
            <div class="card" style="background-color: <?php echo ($i % 2 == 0) ? '#f8d7da' : '#d1ecf1'; ?>;">
              <div class="card-body">
                <h3 class="card-title">
                  <a class="body-text-title_hot" href="product.php?id=<?php echo $producthot[$i]['id']; ?>">
                    <?php
                    $title = (strlen($producthot[$i]['title']) > 150) ? substr($producthot[$i]['title'], 0, 147) . '...Xem Thêm' : $producthot[$i]['title'];
                    echo $title;
                    ?>
                  </a>
                </h3>
                <p class="card-text"><?php echo $producthot[$i]['username']; ?></p>
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>
 

  <!-- Navigation Buttons -->
  <!-- Navigation Buttons -->
<div class="navigation">
  <button class="nav-btn" data-slide="1"></button>
  <button class="nav-btn" data-slide="2"></button>
</div>
</div>
            </div>
            <div class="col-md-2">
                <div class="box-tab">
                <a href="#nr-new" class="item active">Tin</a>
                <a href="#nr-read" class="item">Đọc nhiều</a>
                </div>
            
            </div>
        </div>

      </div>
    </section>


    <section class="main">
    <div class="container">
    <div class="row">
        <div class="col-md-10">
            <?php foreach ($categories as $category) :
                $products = $productModel->findByCategory($category['id'], 4); 
            ?>
                <div class="heading-block">
                <h2 class="title-category"> <a href=""><?php echo $category['name']; ?></a></h2>
                </div>
               
                <div class="border rounded p-3 mb-4">
                    <div class="row">
                        <!-- Bài viết lớn -->
                        <?php if (!empty($products)) : ?>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <img src="public/images/<?php echo $products[0]['image_url']; ?>" class="card-img-top" alt="Main News">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a class="body-text-title" href="product.php?id=<?php echo $products[0]['id']; ?>">
                                                <?php echo $products[0]['title']; ?>
                                            </a>
                                        </h5>
                                        <p class="card-text"><?php echo substr($products[0]['content'], 0, 150) . '...'; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Danh sách bài viết nhỏ -->
                        <div class="col-md-6">
                            <?php for ($i = 1; $i < count($products); $i++) : ?>
                                <div class="d-flex mb-3">
                                    <img src="public/images/<?php echo $products[$i]['image_url']; ?>" alt="Thumbnail" class="me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                    <div>
                                        <h6>
                                            <a class ="body-text-title" href="product.php?id=<?php echo $products[$i]['id']; ?>">
                                                <?php echo $products[$i]['title']; ?>
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Cột khác, giữ nguyên -->
        <div class="col-md-2">
            <div class="read-much">
            <h3 class="item-read-much">Đang đọc</h3>          
            </div>
           
            <?php foreach ($recentProducts as $product) : ?>
                <div class="card bg-primary-subtle mb-3">
                    <img src="<?php echo $product['image_url']; ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="body-text-title" href="product.php?id=<?php echo $product['id']; ?>"><?php echo $product['title']; ?></a>
                        </h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>



    </section>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".slide");
    const navButtons = document.querySelectorAll(".nav-btn");
    let currentIndex = 0;
    const intervalTime = 5000; // 5 giây
  
    // Hàm chuyển đổi slide
    const goToSlide = (index) => {
      slides.forEach((slide, i) => {
        slide.style.display = i === index ? "block" : "none";
      });
      navButtons.forEach((btn, i) => {
        btn.classList.toggle("active", i === index);
      });
      currentIndex = index;
    };
  
    // Xử lý sự kiện khi nhấn nút điều hướng
    navButtons.forEach((btn, index) => {
      btn.addEventListener("click", () => {
        goToSlide(index);
        clearInterval(autoSlide); // Dừng tự động khi người dùng nhấn
        autoSlide = setInterval(nextSlide, intervalTime); // Bắt đầu lại
      });
    });
  
    // Hàm tự động chuyển slide
    const nextSlide = () => {
      const nextIndex = (currentIndex + 1) % slides.length;
      goToSlide(nextIndex);
    };
  
    // Tự động chuyển slide
    let autoSlide = setInterval(nextSlide, intervalTime);
  
    // Hiển thị slide đầu tiên
    goToSlide(currentIndex);
  });
    </script>