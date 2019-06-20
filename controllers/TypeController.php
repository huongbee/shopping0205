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
        $products = $model->getProductByType($url);
        $data = [
            'products'=> $products,
            'nameType'=> $type->name
        ];
        return parent::loadView('type', $data['nameType'], $data);
    }
}
?>