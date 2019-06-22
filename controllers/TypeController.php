<?php
require_once 'Controller.php';
require_once 'models/TypeModel.php';
require_once 'helpers/Pager.php';

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
        
        $pager = new Pager($totalProduct, $page, $qty, 3);
        $showPagination = $pager->showPagination();
        // echo $totalPage; die;
        $data = [
            'products'=> $products,
            'nameType'=> $type->name,
            'showPagination'=>$showPagination
        ];
        return parent::loadView('type', $data['nameType'], $data);
    }
}
?>