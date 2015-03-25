<?php

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { http_response_code(404); die(); };

if(@!is_array($GLOBALS['CONFIG'])){ $GLOBALS['CONFIG'] = array();}  


require_once (APPLICATION_DIR. '/libs/autoload.php');

require_once (APPLICATION_DIR. '/config.php');

ActiveRecord\Config::initialize(function($cfg)
{
	$cfg->set_model_directory(APPLICATION_DIR.'/models');
	$cfg->set_connections(array(
		'development' => 'mysql://'.$GLOBALS['CONFIG']['db_username'].':'.$GLOBALS['CONFIG']['db_password'].'@'.$GLOBALS['CONFIG']['db_hostname'].'/'.$GLOBALS['CONFIG']['db_name']));
});


$klein = new \Klein\Klein();



$klein->respond(function ($request, $response, $service, $app) use ($klein) {
	$app->register('blade', function () {
		$views = APPLICATION_DIR. "/views";
		$cache = APPLICATION_DIR. "/cache";

		$blade = new Philo\Blade\Blade($views, $cache);

		return $blade;
	});

    // Handle exceptions => flash the message and redirect to the referrer
    $klein->onError(function ($klein, $err_msg) {
        $klein->service()->flash($err_msg);
        $klein->service()->back();
    });
});

require_once (APPLICATION_DIR."/router.php");

$klein->dispatch();