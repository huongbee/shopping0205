<?php
class Controller{
    static function loadView(string $view = 'index'){
        require_once 'views/master.view.php';
    }
}


?>