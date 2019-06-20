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
    function getProductByType(string $urlType){
        $sql = "SELECT p.*, u.url
                FROM products p
                INNER JOIN page_url u
                ON p.id_url = u.id
                WHERE p.id_type = (
                    SELECT c.id
                    FROM categories c
                    INNER JOIN page_url pu
                    ON c.id_url = pu.id
                    WHERE pu.url = '$urlType'
                )";
        return $this->getMoreRows($sql);
    }
    function getTypeByUrl($url){
        $sql = "SELECT c.name
                FROM categories c
                INNER JOIN page_url pu
                ON c.id_url = pu.id
                WHERE pu.url = '$url'";
        return $this->getOneRow($sql);
              
    }
}

?>