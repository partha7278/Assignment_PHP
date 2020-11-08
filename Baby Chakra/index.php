<?php 

require 'config.php';
require "cacheSystem/cache.php";

$cacheService = new CacheService;
print_r($cacheService->fetch('user:14'));

?>