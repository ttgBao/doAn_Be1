<?php
session_start();
session_destroy();
header('Location: http://localhost/be1_article_mysql/');
