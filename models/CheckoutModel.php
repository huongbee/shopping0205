<?php
require_once 'DBConnect.php';
class CheckoutModel extends DBConnect{

    function insertCustomer($name, $gender, $email, $address, $phone){
        $sql = "INSERT INTO customers
                (name, gender, email, address, phone)
                VALUES 
                ('$name', '$gender', '$email', '$address', '$phone')";
        $check = $this->executeQuery($sql);
        if($check) return $this->getRecentIdInsert();
        return false;
    }
    function insertBill($idCustomer, $dateOrder, $total, $promtPrice, $paymentMethod, $note, $token, $tokenDate, $status){
        $sql = "";

    }
    function insertBillDetail($idBill, $idProduct, $quantity, $price, $discountPrice){
        $sql = "";

    }
}

?>