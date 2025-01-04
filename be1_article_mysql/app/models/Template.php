<?php
class Template
{
    function render($view, $data) {
        ob_start();
        extract($data);
        include "app/views/blocks/$view.php";
        
        return ob_get_clean();
    }

    function view($view, $data) {
        extract($data);
        include "app/views/$view.php";
    }
    function renderadmin($view, $data) {
        ob_start();
        extract($data);
        include __DIR__ . "/../views/adminblocks/$view.php";
        
        return ob_get_clean();
    }

    function viewadmin($view, $data) {
        extract($data);
        include __DIR__ . "/../views/$view.php";
    }
}
