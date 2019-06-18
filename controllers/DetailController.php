<?php
require_once 'Controller.php';
class DetailController extends Controller{
    function getDetailPage(){
        $url = $_GET['link'];
        echo $url;
        die;
        $title = 'San pham a';
        return parent::loadView('detail',$title);
    }
}


?>