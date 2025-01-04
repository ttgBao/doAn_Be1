<?php
class User extends Database
{
    public function register($username, $password) {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare('INSERT INTO `users`(`username`, `password`) VALUES (?, ?)');
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql->bind_param('ss', $username, $password);

        // 3 & 4
        return $sql->execute();
    }

    public function login($username, $password) {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare('SELECT * FROM `users` WHERE `username`=?');        
        $sql->bind_param('s', $username);
        $user = parent::select($sql);

        if(count($user) > 0) {
            if(password_verify($password, $user[0]['password'])) {
                return $user[0];
            }     
        }
        
        // 3 & 4
        return false;
    }


    
         function checkEmail($email) {
        $sql = parent::$connection->prepare('SELECT * FROM `users` WHERE `email` = ?');
        $sql->bind_param('s', $email);
        return parent::select($sql)[0];   
    }
    
    public function saveResetToken($email, $token, $expires_at) {
        $sql = parent::$connection->prepare('UPDATE `users` SET `reset_token` = ?, `reset_expires` = ? WHERE `email` = ?');
        $sql->bind_param('sss', $token, $expires_at, $email);
        return $sql->execute();
    }
    
    public function checkResetToken($token) {
        $sql = parent::$connection->prepare('SELECT * FROM `users` WHERE `reset_token` = ? AND `reset_expires` > NOW()');
        $sql->bind_param('s', $token);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_assoc(); // Trả về thông tin người dùng nếu token hợp lệ
    }
    
    public function updatePassword($email, $new_password) {
        $sql = parent::$connection->prepare('UPDATE `users` SET `password` = ?, `reset_token` = NULL, `reset_expires` = NULL WHERE `email` = ?');
        $sql->bind_param('ss', $new_password, $email);
        return $sql->execute();
    }
    
    
}
