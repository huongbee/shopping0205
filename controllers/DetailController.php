<?php
require_once 'Controller.php';
class DetailController extends Controller{
    function getDetailPage(){
        $title = 'San pham a';
        return parent::loadView('detail',$title);
    }
}


?>