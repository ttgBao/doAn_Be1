<div class="container">
        <h1>
            Manage Products <a href="add.php" class="btn btn-outline-primary">Add</a>
            <a href="bin.php" class="btn btn-outline-primary">BIN</a>
            <a href="approved.php" class="btn btn-outline-primary">Approved</a>
        </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Content</th>
                    <th>title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products as $product) :
                ?>
                <tr>
                    <td><?php echo $product['id'] ?></td>
                    <td><?php echo $product['content'] ?></td>
                    <td><?php echo $product['title'] ?></td>
                    <td><img src="../../public/images/<?php echo $product['image_url'] ?>" width="50"></td>
                    <td>
                    <?php
                        echo (!empty($product['category_name'])) ? implode(array_map(function ($e) {
                            return "<span class='badge text-bg-warning'>$e</span>";
                        }, explode(',', $product['category_name']))) : '';
                    ?>
                    </td>
                   
                    <td>
                        <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-outline-primary">Edit</a>
                        <form action="index.php" method="post" onsubmit="return confirm('Xóa không?')">
                            <input type="hidden" name="product-id" value="<?php echo $product['id'] ?>">
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
                endforeach;
                ?>

            </tbody>
        </table>
    </div>