<?php
require_once 'Controller.php';

class CheckoutController extends Controller{
    static function getCheckoutPage(){
        return parent::loadView('checkout');
    }
}
?>