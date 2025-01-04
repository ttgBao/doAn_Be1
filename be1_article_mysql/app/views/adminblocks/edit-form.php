<div class="container">
        <h1>Edit Product</h1>
        <form action="edit.php?id=<?php echo $product['id'] ?>" method="post"  enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $product['title'] ?>">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content"><?php echo $product['content'] ?></textarea>
                
            </div>
            <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="text" name ="image" id="image" value="<?php echo $product['image_url'] ?>">;
                        <input class="form-control" type="file" name ="imagefile" id="imagefile" value="<?php echo $product['image_url'] ?>">;
            </div>  
            
           
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <?php
                foreach ($categories as $category) :
                    $checked = (!empty($product['category_ids']) && in_array($category['id'], explode(',', $product['category_ids']))) ? 'checked' : '';
                ?>
                <input type="checkbox" class="btn-check" id="category-<?php echo $category['id'] ?>" autocomplete="off" value="<?php echo $category['id'] ?>" name="category-id[]" <?php echo $checked ?>>
                
                
                <label class="btn btn-outline-primary" for="category-<?php echo $category['id'] ?>"><?php echo $category['name'] ?></label>
                <?php
                endforeach;
                ?>
                
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>