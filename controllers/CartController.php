<?php
require_once 'Controller.php';
require_once 'models/CartModel.php';
require_once 'helpers/Cart.php';
session_start();

class CartController extends Controller{
    static function getCartPage(){
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $data = [
            'cart' => $cart
        ];
        return parent::loadView('cart','Giỏ hàng của bạn', $data);
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
    static function deleteCart(){
        $id = $_POST['id'];
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        $_SESSION['cart'] = $cart;
        echo json_encode([
            'success'=> true,
            'totalPrice' => number_format($cart->totalPrice),
            'promtPrice' => number_format($cart->promtPrice)
        ]);
    }
    static function updateCart(){
        $id = $_POST['id'];
        $qty = $_POST['quantity'];
        echo $id .' - '. $qty;
    }

}
?>