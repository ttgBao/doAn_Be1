<div class="container text-center">
 
  Manage Articles <a href="index.php" class="btn btn-outline-primary">Home</a>
  <div class="row align-items-start">
    <div class="col-6 mx-auto"> <!-- Chiếm 6 cột và căn giữa -->
           <?php
            foreach ($products as $product) :
            ?>

      <div class="card">
        <img src="../../<?php echo $product['image_url']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?php echo $product['title']; ?></h5>
          <?php echo $product['content']; ?>
        </div>
        <div class="card-footer">
              <form action="approved.php" method="post">
              <input type="hidden" name="product-id" value="<?php echo $product['id'] ?>">
              <button type="submit" class="btn btn-outline-primary" name="btn-approved" value="<?php echo $product['id'] ?>" >Phê duyệt</button>
              <button type="submit" class="btn btn-danger" name ="btn-refuse" value="<?php echo $product['id'] ?>">Từ chối</button>
              </form>
       
        </div>
            <?php
            endforeach;
            ?>
      </div>
    </div>
  </div>  

  
</div>
