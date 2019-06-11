<?php
require_once 'Controller.php';

class IndexController extends Controller{
    static function getHomePage(){
        return parent::loadView('index');
    }
}
?>