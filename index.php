<?php
$link = 'http://localhost/shopping0205/phu-kien/4';
$arr = explode('/', $link);
print_r($arr);

unset($arr[count($arr)-1]);
$new  = implode('/',$arr);

echo $new;
// print_r($arr);



die;
require_once 'controllers/IndexController.php';
IndexController::getHomePage();



?>