<?php
require_once 'Controller.php';

class TypeController extends Controller{
    static function getTypePage(){
        return parent::loadView('type','Type page');
    }
}
?>