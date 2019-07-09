<?php
require_once 'Controller.php';
require_once 'models/CheckoutModel.php';
require_once 'helpers/Cart.php';
require_once 'helpers/functions.php';
require_once 'helpers/PHPMailer/sendmail.php';
session_start();

class CheckoutController extends Controller{
    function __construct(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }
    static function getCheckoutPage(){
        return parent::loadView('checkout');
    }
    static function postCheckout(){
        if($_POST['fullname'] =='' || $_POST['email'] == '' || $_POST['gender'] == '' || $_POST['phone'] == '' || $_POST['address'] == '' || $_POST['payment_method']==''){
            $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
            header('Location: http://localhost/shopping0205/checkout.php');
            return;
        }
        $name = $_POST['fullname'];
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
            header('Location: http://localhost/shopping0205/checkout.php');
            return;
        }
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        if($cart == null){
            $_SESSION['error'] = 'Vui lòng mua hàng';
            header('Location: http://localhost/shopping0205/checkout.php');
            return;
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateOrder = date('Y-m-d', time());
        $total = $cart->totalPrice;
        $promtPrice = $cart->promtPrice;
        $token = createToken(); 
        $tokenDate = date('Y-m-d H:i:s', time());

        $idBill = $model->insertBill($idCustomer, $dateOrder, $total, $promtPrice, $paymentMethod, $note, $token, $tokenDate, 0);
        if(!$idBill){
            $_SESSION['error'] = 'Vui lòng thử lại 2';
            header('Location: http://localhost/shopping0205/checkout.php');
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
                header('Location: http://localhost/shopping0205/checkout.php');
                return;
            }
        }
        // send email 
        $link = "http://localhost/shopping0205/accept-order/$token";
        $totalCart = number_format($total);
        $body = "
            <p>Chào $name,</p>
            <p>Cảm ơn bạn đã mua hàng, tổng giá trị đơn hàng là: $totalCart vnđ</p>
            <p>Bạn vui lòng nhấp vào <a href='$link'>liên kết</a> để xác nhận đơn hàng.</p>
            <p><i>Shop 0205</i><p>
        ";
        $title = "SHOP0205 Xác nhận đơn hàng DH-000$idBill";
        $mail = sendMail($email, $name, $body, $title);
        if($mail){
            // clear SESSION
            unset($_SESSION['cart']);
            $_SESSION['success'] = 'Đặt hàng thành công, vui lòng kiểm tra email để xác nhận đơn hàng';
            header('Location: http://localhost/shopping0205/checkout.php');
            return;
        }
        else{
            $_SESSION['error'] = 'Vui lòng thử lại 3';
            header('Location: http://localhost/shopping0205/checkout.php');
            return;
        }
    }
    function acceptOrder(){
        $token = $_GET['token']; 
        if(!isset($token) || strlen($token) != 40){
            header('Location: 404.html');
            return;
        }
        $model = new CheckoutModel();
        $bill = $model->findBillByToken($token);
        if(!$bill){
            $_SESSION['error'] = 'Liên kết fail, vui lòng thử lại.';
            header('location: http://localhost/shopping0205/checkout.php');
            return;
        }

        $tokenTime = strtotime($bill->token_date);
        $now = time();
        if($now - $tokenTime <= 86400){
            // update trang thai
            $check = $model->updateStatusBill($bill->id);
            if($check){
                    $_SESSION['success'] = 'ĐH của bạn đã được xác nhận. Chúng tôi sẽ liên hệ bạn để giao hàng trong time soon.';
                    header('location: http://localhost/shopping0205/checkout.php');
            }
            else{
                $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng thử lại.';
                header('location: http://localhost/shopping0205/checkout.php');
            }
        }
        else {
            $_SESSION['error'] = 'ĐH của bạn đã hết hiệu lực để xác nhận, vui lòng đặt hàng lại.';
            header('location: http://localhost/shopping0205/checkout.php');
        }


    }
}
?>