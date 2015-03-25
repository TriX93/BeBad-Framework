<?php

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { http_response_code(404); die(); };

foreach(array('game', 'users') as $controller) {
    // Include all routes defined in a file under a given namespace
    $klein->with("/$controller", APPLICATION_DIR."/controllers/$controller.php");
}

$klein->with("/", APPLICATION_DIR."/controllers/home.php");
