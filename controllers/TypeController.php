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
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $position = ($page-1)*$qty;
        $products = $model->getProductByType($url, $position, $qty);
        $totalProduct = count($model->getProductByType($url));
        $totalPage = ceil($totalProduct/$qty);
        
        // echo $totalPage; die;
        $data = [
            'products'=> $products,
            'nameType'=> $type->name
        ];
        return parent::loadView('type', $data['nameType'], $data);
    }
}
?>