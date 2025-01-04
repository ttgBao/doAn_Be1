<div class="container">
    <div class="row">
            <div class="col-md-12">
                    <div class="border rounded p-3">
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <?php
                            foreach ($products as $product) :
                            ?>
                                <div class="col">
                                    <div class="card bg-primary-subtle">
                                    <img src="public/images/<?php echo $product['image_url']; ?>" class="card-img-top" alt="Product Image">
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
            </div>
            <div class="col-md-2">
              

            
            </div>
        </div>

    </div>