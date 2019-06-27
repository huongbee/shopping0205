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
        if(!isset($_POST['id'])){
            echo json_encode([
                'success' => false,
                'message' => 'Missing id product!',
                'data' => null
            ]) ;
            return false;
        }
        $id = $_POST['id'];
        $qty = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
        $model = new CartModel();
        $product = $model->findProductById($id);
        
        if(!$product){
            echo json_encode([
                'success' => false,
                'message' => 'Cannot find product!',
                'data' => null
            ]) ;
            return false;
        }

        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $qty);

        $_SESSION['cart'] = $cart; // obj
        echo json_encode([
            'success' => true,
            'message' => 'Add to cart success!',
            'data' => [
                'product_name' => $product->name
            ]
        ]) ;
        return false;
    }
    static function deleteCart(){}
    static function updateCart(){}

}
?>