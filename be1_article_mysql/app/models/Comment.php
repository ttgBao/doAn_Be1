<?php
class Comment extends Database
{
    public function add($content, $productId, $userId) {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare('INSERT INTO `comments`(`content`, `product_id`, `user_id`) VALUES (?, ?, ?)');
        $sql->bind_param('sii', $content, $productId, $userId);

        // 3 & 4
        return $sql->execute();
    }


    public function find($productId)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT 
        `comments`.*, 
        `users`.`username` AS users_name
    FROM 
        `comments`
    LEFT JOIN 
        `users`
    ON 
        `comments`.`user_id` = `users`.`id`
    WHERE 
        `comments`.`product_id` =?
    ORDER BY 
        `comments`.`id` DESC;");
        $sql->bind_param('i', $productId);
        // 3 & 4
        return parent::select($sql);
    }
}
