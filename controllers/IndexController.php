<?php
require_once 'Controller.php';
require_once 'models/IndexModel.php';

class IndexController extends Controller{
    static function getHomePage(){
        $slides = IndexModel::getSlides();
        print_r($slides); die;
        return parent::loadView('index','Trang chủ');
    }
}
?>