<?php
require_once 'DBConnect.php';

class IndexModel extends DBConnect{
    function getSlides(){
        $sql = "SELECT * FROM slide WHERE status=1";
        return parent::getMoreRows($sql);
    }
    function getFeaturedProduct(){
        // status=1 --> sp dac biet
        $sql = "SELECT *
                FROM products 
                WHERE status=1
                AND deleted=0
                ORDER BY id DESC
                LIMIT 0,10"; // undeleted
        return $this->getMoreRows($sql);
    }
}

?>