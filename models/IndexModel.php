<?php
require_once 'DBConnect.php';

class IndexModel extends DBConnect{
    function getSlides(){
        $sql = "SELECT * FROM slide WHERE status=1";
        return parent::getMoreRows($sql);
    }
}

?>