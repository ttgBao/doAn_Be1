<div class="container">
        <form action="bin.php" method="post" onsubmit="return confirm('Thực hiện không?')">
            <h1>
                Manage Products <a href="index.php" class="btn btn-outline-primary">Products</a>
                <button type="submit" class="btn btn-outline-danger" name="btn-empty">Empty</button>
            </h1>
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="" class="form-check-input" onclick="checkAll(this)"></th>
                        <th>ID</th>
                        <th>title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($products as $product) :
                    ?>
                        <tr>
                            <td><input type="checkbox" name="id-delete[]" class="form-check-input check-id" value="<?php echo $product['id'] ?>"></td>
                            <td><?php echo $product['id'] ?></td>
                            <td><?php echo $product['title'] ?></td>
                            <td><?php echo $product['content'] ?></td>
                            <td><img src="../../public/images/<?php echo $product['image_url'] ?>" width="50"></td>
                            <td>
                                <button type="submit" class="btn btn-outline-success" name="btn-restore" value="<?php echo $product['id'] ?>">Restore</button>
                                
                                <button type="submit" class="btn btn-outline-danger" name="btn-delete" value="<?php echo $product['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>

                </tbody>
            </table>
        </form>
    </div>

    <!-- <form action="bin.php" method="post" onsubmit="return confirm('Restore không?')" id="form-restore">
    </form>

    <form action="bin.php" method="post" onsubmit="return confirm('Xóa không?')" id="form-delete">
    </form> -->

    <script>
        function checkAll(thisCheck) {
            const checkId = document.querySelectorAll('.check-id');

            if (thisCheck.checked == true) {
                checkId.forEach(element => {
                    element.setAttribute('checked', 'checked');
                });
            } else {
                checkId.forEach(element => {
                    element.removeAttribute('checked');
                });
            }
        }
    </script>