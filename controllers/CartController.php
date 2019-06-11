<?php
require_once 'Controller.php';

class CartController extends Controller{
    static function getCartPage(){
        return parent::loadView('cart');
    }
}
?>