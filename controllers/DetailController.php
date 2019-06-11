<?php
require_once 'Controller.php';
class DetailController extends Controller{
    function getDetailPage(){
        return parent::loadView('detail');
    }
}


?>