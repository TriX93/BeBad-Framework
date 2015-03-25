<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { http_response_code(404); die(); };

$GLOBALS['CONFIG']['db_password'] = "";
$GLOBALS['CONFIG']['db_username'] = "";
$GLOBALS['CONFIG']['db_hostname'] = "localhost";
$GLOBALS['CONFIG']['db_name'] = "";