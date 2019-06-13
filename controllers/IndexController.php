<?php
require_once 'Controller.php';
require_once 'models/IndexModel.php';

class IndexController extends Controller{
    static function getHomePage(){
        $model = new IndexModel();
        $slides = $model->getSlides();
        $data = [
            'slides'=>$slides,
        ];
        $title = 'Trang chủ';
        // print_r($slides); die;
        return parent::loadView('index',$title, $data);
    }
}
?>