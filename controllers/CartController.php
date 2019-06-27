<?php
require_once 'Controller.php';
require_once 'models/CartModel.php';
require_once 'helpers/Cart.php';
session_start();

class CartController extends Controller{
    static function getCartPage(){
        return parent::loadView('cart');
    }
    static function addToCart(){
        $id = $_POST['id'];
        $qty = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
        $model = new CartModel();
        $product = $model->findProductById($id);
        
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $qty);

        $_SESSION['cart'] = $cart; // obj
        print_r($_SESSION['cart']);
    }
    static function deleteCart(){}
    static function updateCart(){}

}
?>