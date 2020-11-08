<?php
//load radis client-lib
require "predis/autoload.php";

Predis\Autoloader::register();

try {
	$redis = new Predis\Client(RADIS_CONNECTION);
}
catch (Exception $e) {
	die($e->getMessage());
}