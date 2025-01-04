<?php
class Product extends Database
{
    public function all()
    {
        // 2. Tạo câu query
        // $sql = parent::$connection->prepare('SELECT * from `products`');
        $sql = parent::$connection->prepare('SELECT `articles`.*, GROUP_CONCAT(`categories`.`name`) AS category_name
                                            FROM `articles`
                                            LEFT JOIN `category_product`
                                            ON `articles`.`id` = `category_product`.`product_id`
                                            LEFT JOIN `categories`
                                            ON `categories`.`id` = `category_product`.`category_id`
                                            WHERE `articles`.`status`=1
                                            GROUP BY `articles`.`id`
                                            ');
        // 3 & 4
        return parent::select($sql);
    }
    public function home() {
        $sql = parent::$connection->prepare("SELECT `articles`.*, GROUP_CONCAT(`categories`.`name` SEPARATOR ', ') AS category_name
        FROM `articles`
        LEFT JOIN `category_product`
        ON `articles`.`id` = `category_product`.`product_id`
        LEFT JOIN `categories`
        ON `categories`.`id` = `category_product`.`category_id`
        WHERE `articles`.`status` = 1
        GROUP BY `articles`.`id`
        ORDER BY `articles`.`updated_at` DESC
        LIMIT 3;
        ");
    return parent::select($sql);
    }
    public function findByKeyWord($keyword)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT * FROM `articles` WHERE `title` LIKE ?");
        $keyword = "%{$keyword}%";
        $sql->bind_param('s', $keyword);
        // 3 & 4
        return parent::select($sql);
    }
    public function add($title, $content, $image,$categoryIds)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("INSERT INTO `articles`( `title`, `content`, `image_url`) VALUES (?,?,?)");
        $sql->bind_param('sss', $title, $content,$image);
        // 3 & 4
         $sql->execute();

        // 2. Tạo câu query
        $productId = parent::$connection->insert_id;
        // Tạo chuỗi kiểu (?, id), (?, id), (?, id)
        $insertPlace = str_repeat("(?, $productId),", count($categoryIds) - 1) . "(?, $productId)";
        // Tạo chuỗi iiiiiiii
        $insertType = str_repeat('i', count($categoryIds));

        $sql = parent::$connection->prepare("INSERT INTO `category_product`(`category_id`, `product_id`) VALUES $insertPlace");

        $sql->bind_param($insertType, ...$categoryIds); 
        return $sql->execute();
    }
    public function userAdd($title, $content, $image,$categoryIds,$authorIds)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("INSERT INTO `articles`( `title`, `content`, `image_url`,`author_id`) VALUES (?,?,?,?)");
        $sql->bind_param('sssi', $title, $content,$image,$authorIds);
        // 3 & 4
         $sql->execute();
         $productId = parent::$connection->insert_id;
         $sql = parent::$connection->prepare("UPDATE `articles` SET `status`=0 WHERE `author_id`=?");
         $sql->bind_param('i', $authorIds);
         $sql->execute();

        // 2. Tạo câu query
 
        // Tạo chuỗi kiểu (?, id), (?, id), (?, id)
        $insertPlace = str_repeat("(?, $productId),", count($categoryIds) - 1) . "(?, $productId)";
        // Tạo chuỗi iiiiiiii
        $insertType = str_repeat('i', count($categoryIds));

        $sql = parent::$connection->prepare("INSERT INTO `category_product`(`category_id`, `product_id`) VALUES $insertPlace");

        $sql->bind_param($insertType, ...$categoryIds); 
        return $sql->execute();
    }


    public function update($title, $content, $image,$productId, $categoryIds)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("UPDATE `articles` SET `title`=?,`content`=?,`image_url`=? WHERE id =?");
        $sql->bind_param('sssi', $title, $content, $image, $productId);
        // 3 & 4
         $sql->execute();


        // Xóa categories cũ
        $sql = parent::$connection->prepare("DELETE FROM `category_product` WHERE `product_id`=?");
        $sql->bind_param('i', $productId);
        // 3 & 4
        $sql->execute();


        // Thêm categories mới
        // 2. Tạo câu query
 
        // Tạo chuỗi kiểu (?, id), (?, id), (?, id)
        $insertPlace = str_repeat("(?, $productId),", count($categoryIds) - 1) . "(?, $productId)";
        // Tạo chuỗi iiiiiiii
        $insertType = str_repeat('i', count($categoryIds));

        $sql = parent::$connection->prepare("INSERT INTO `category_product`(`category_id`, `product_id`) VALUES $insertPlace");

        $sql->bind_param($insertType, ...$categoryIds); 
        return $sql->execute();


       
    }
    public function findCategoryName($id)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT 
                                                `articles`.*, 
                                                GROUP_CONCAT(`categories`.`name`) AS 'category_names',
                                                GROUP_CONCAT(`category_product`.`category_id`) AS 'category_ids'
                                            FROM 
                                                `articles`
                                            LEFT JOIN 
                                                `category_product`
                                            ON 
                                                `articles`.`id` = `category_product`.`product_id`
                                            LEFT JOIN 
                                                `categories`
                                            ON 
                                                `category_product`.`category_id` = `categories`.`id`
                                            WHERE 
                                                `articles`.`id` = ?
                                            GROUP BY 
                                                `articles`.`id`");
        $sql->bind_param('i', $id);
        // 3 & 4
        return parent::select($sql)[0];
    }
    public function find($id)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT `articles`.*, GROUP_CONCAT(`category_product`.`category_id`) AS 'category_ids'
                                            FROM `articles`
                                            LEFT JOIN `category_product`
                                            ON `articles`.`id` = `category_product`.`product_id`
                                            WHERE `id`=?
                                            GROUP BY `articles`.`id`");
        $sql->bind_param('i', $id);
        // 3 & 4
        return parent::select($sql)[0];
    }
    public function allBin()
    {
        // 2. Tạo câu query
        // $sql = parent::$connection->prepare('SELECT * from `products`');
        $sql = parent::$connection->prepare('SELECT  `articles` .* FROM `articles` WHERE `articles`.`status`=0');
        // 3 & 4
        return parent::select($sql);
    }
    public function bin($productId)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("UPDATE `articles` SET `status`=0 WHERE `id`=?");
        $sql->bind_param('i', $productId);
        // 3 & 4
        return $sql->execute();
    }
    public function restore($productId)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("UPDATE `articles` SET `status`=1 WHERE `id`=?");
        $sql->bind_param('i', $productId);
        // 3 & 4
        return $sql->execute();
    }
    public function delete($productId)
    {
        // 2. Tạo câu query
        // Xóa categories cũ
        $sql = parent::$connection->prepare("DELETE FROM `category_product` WHERE `product_id`=?");
        $sql->bind_param('i', $productId);
        // 3 & 4
        $sql->execute();

        
        $sql = parent::$connection->prepare("DELETE FROM `articles` WHERE `id`=?");
        $sql->bind_param('i', $productId);
        // 3 & 4
        return $sql->execute();
    }
    public function deleteAll($productIds)
    {
        // Tạo chuỗi kiểu ?,?,?
        $insertPlace = str_repeat("?,", count($productIds) - 1) . "?";
        // Tạo chuỗi iiiiiiii
        $insertType = str_repeat('i', count($productIds));


        // 2. Tạo câu query
        // Xóa categories cũ
        $sql = parent::$connection->prepare("DELETE FROM `category_product` WHERE `product_id` IN ($insertPlace)");
        $sql->bind_param($insertType, ...$productIds);
        // 3 & 4
        $sql->execute();

        
        $sql = parent::$connection->prepare("DELETE FROM `articles` WHERE `id` IN ($insertPlace)");
        $sql->bind_param($insertType, ...$productIds);

        // 3 & 4
        return $sql->execute();
    }
    public function findByCategory($id, $limit = '')
    {
        $limit = ($limit != '') ? "LIMIT $limit" : '';
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT *
                                            FROM `category_product`
                                            INNER JOIN `articles`
                                            ON `category_product`.`product_id` = `articles`.`id`
                                            WHERE `category_id` = ? 
                                            AND `articles`.`status` = 1
                                            $limit");
        $sql->bind_param('i', $id);
        // 3 & 4
        return parent::select($sql);
    }
    public function findIds($productIds)
    {
         // Tạo chuỗi kiểu ?,?,?
        $insertPlace = str_repeat("?,", count($productIds) - 1) . "?";
        // Tạo chuỗi iiiiiiii
        $insertType = str_repeat('i', count($productIds) * 2);

        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT * FROM `articles` WHERE `id` IN ( $insertPlace ) ORDER BY FIELD(id, $insertPlace) DESC");
        $sql->bind_param($insertType, ...$productIds, ...$productIds);
        // 3 & 4
        return parent::select($sql);
    }
    public function findRecent($limit = 10)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT `articles`.*, GROUP_CONCAT(`category_product`.`category_id`) AS 'category_ids'
                                            FROM `articles`
                                            LEFT JOIN `category_product`
                                            ON `articles`.`id` = `category_product`.`product_id`
                                            GROUP BY `articles`.`id`
                                            ORDER BY `articles`.`id` DESC
                                            LIMIT ?");
        $sql->bind_param('i', $limit);
        // 3 & 4
        return parent::select($sql);
    }
    public function allApproved()
    {
        // 2. Tạo câu query
        // $sql = parent::$connection->prepare('SELECT * from `products`');
        $sql = parent::$connection->prepare('SELECT `articles`.* 
        FROM `articles` 
        WHERE `articles`.`is_approved` = 0 
          AND `articles`.`author_id` > 0;
        ');
        // 3 & 4
        return parent::select($sql);
    }
    public function Approved($authorId)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("UPDATE `articles` SET  `is_approved` =1  WHERE `id`=?");
        $sql->bind_param('i', $authorId);
        // 3 & 4
        return $sql->execute();
    }
    public function articlesHot()
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare('SELECT `articles`.*, 
                                                                        GROUP_CONCAT(`categories`.`name`) AS category_name, 
                                                                        `users`.`username`
                                                                        FROM `articles`
                                                                        LEFT JOIN `category_product` 
                                                                        ON `articles`.`id` = `category_product`.`product_id`
                                                                        LEFT JOIN `categories` 
                                                                        ON `categories`.`id` = `category_product`.`category_id`
                                                                        LEFT JOIN `users` 
                                                                        ON `users`.`id` = `articles`.`author_id`
                                                                        WHERE `articles`.`is_approved` = 1
                                                                        GROUP BY `articles`.`id`, `users`.`username`
                                                                        ORDER BY `articles`.`updated_at` DESC
                                                                        LIMIT 6;');
        // 3 & 4
        return parent::select($sql);
    }

      public function findAuthorName($authorId)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT `users`.`username`
        FROM `users`
        INNER JOIN `articles` ON `users`.`id` = `articles`.`author_id`
        WHERE `articles`.`author_id` = ?");
        $sql->bind_param('i', $authorId);
        // 3 & 4
        return $sql->execute();
    }

  
   
    
}
