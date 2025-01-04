<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'be1');

session_start();
spl_autoload_register(function ($className) {
    $file = __DIR__ . "/../app/models/$className.php";
    if (file_exists($file)) {
        require_once $file;
    } else {
        die("File not found: $file");
    }
});
