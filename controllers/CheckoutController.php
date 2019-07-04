<?php
require_once 'Controller.php';
require_once 'models/CheckoutModel.php';
session_start();

class CheckoutController extends Controller{
    static function getCheckoutPage(){
        return parent::loadView('checkout');
    }
    function postCheckout(){
        if($_POST['name'] =='' || $_POST['email'] == '' || $_POST['gender'] == '' || $_POST['phone'] == '' || $_POST['address'] == '' || $_POST['payment_method']==''){
            $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
            header('http://localhost/shopping0205/checkout.php');
            return;
        }
        $name = $_POST['name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $paymentMethod = $_POST['payment_method'];
        $note = $_POST['note'];

        $model = new CheckoutModel();
        $idCustomer = $model->insertCustomer($name, $gender, $email, $address, $phone);
        if(!$idCustomer){
            $_SESSION['error'] = 'Vui lòng thử lại 1';
            header('http://localhost/shopping0205/checkout.php');
            return;
        }
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        if($cart == null){
            $_SESSION['error'] = 'Vui lòng mua hàng';
            header('http://localhost/shopping0205/checkout.php');
            return;
        }
        $dateOrder = date('Y-m-d', time());
        $total = $cart->totalPrice;
        $promtPrice = $cart->promtPrice;
        $token = ''; 
        $tokenDate = date('Y-m-d H:i:s', time());

        $idBill = $model->insertBill($idCustomer, $dateOrder, $total, $promtPrice, $paymentMethod, $note, $token, $tokenDate, 0);
        if(!$idBill){
            $_SESSION['error'] = 'Vui lòng thử lại 2';
            header('http://localhost/shopping0205/checkout.php');
            return;
        }
        // insert bill_detail
        foreach($cart->items as $idProduct => $cartDetail){
            $quantity = $cartDetail['qty'];
            $price = $cartDetail['price'];
            $promotionPrice = $cartDetail['promotionPrice'];
            $detail = $model->insertBillDetail($idBill, $idProduct, $quantity, $price, $promotionPrice);
            if(!$detail){
                $_SESSION['error'] = 'Vui lòng thử lại 3';
                header('http://localhost/shopping0205/checkout.php');
                return;
            }
        }
        // send email 
        $_SESSION['success'] = 'Đặt hàng thành công, vui lòng kiểm tra email để xác nhận đơn hàng';
        header('http://localhost/shopping0205/checkout.php');
        return;
    }
}
?>