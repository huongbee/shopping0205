<?php
require_once 'controllers/CheckoutController.php';
$c = new CheckoutController;
return $c->acceptOrder();   
?>