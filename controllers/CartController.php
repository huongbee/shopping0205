<?php
require_once 'Controller.php';

class CartController extends Controller{
    static function getCartPage(){
        return parent::loadView('cart');
    }
    static function addToCart(){
        $id = $_POST['id'];
        $qty = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
        
    }
    static function deleteCart(){}
    static function updateCart(){}

}
?>