<?php
require_once 'Controller.php';
require_once 'models/DetailModel.php';

class DetailController extends Controller{
    function getDetailPage(){
        $url = $_GET['link'];
        $model = new DetailModel();
        $product = $model->getDetailProduct($url);
        if(!$product){
            header('Location:404.html');
            return;
        }
        $title = $product->name;
        $data = [
            'product'=>$product,
        ];
        return parent::loadView('detail',$title, $data);
    }
}


?>