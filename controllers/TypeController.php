<?php
require_once 'Controller.php';
require_once 'models/TypeModel.php';

class TypeController extends Controller{
    static function getTypePage(){
        if(!isset($_GET['link'])){
            header('Location: 404.html');
            return;
        }
        $url = $_GET['link'];
        $model = new TypeModel();
        $type = $model->getTypeByUrl($url);
        
        if(!$type){
            header('Location: 404.html');
            return;
        }
        $qty = 8;
        $position = 0;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else $page = 1;
        // echo $page; die;
        $products = $model->getProductByType($url, $position, $qty);
        $data = [
            'products'=> $products,
            'nameType'=> $type->name
        ];
        return parent::loadView('type', $data['nameType'], $data);
    }
}
?>