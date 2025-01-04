<div class="container">
        <h4>Có <?php echo count($products) ?> kết quả cho từ khóa "<?php echo $q ?>"</h4>
        <div class="row row-cols-1 row-cols-md-5 g-4">

            <?php
            foreach ($products as $product) :
            ?>

                <div class="col">
                    <div class="card">
                        <img src="public/images/<?php echo $product['image_url'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"> <a class="body-text-title" href="product.php?id=<?php echo $product['id'] ?>"><?php echo $product['title'] ?></a> </h5>
                        
                        </div>
                    </div>
                </div>

            <?php
            endforeach;
            ?>
        </div>
    </div>