<?php
require_once 'DBConnect.php';

class TypeModel extends DBConnect{
    function getCategory(){
        $sql = "SELECT c.*, u.url
                FROM categories c
                INNER JOIN page_url u
                ON c.id_url = u.id
                WHERE status=1";
        return parent::getMoreRows($sql);
    }
}

?>