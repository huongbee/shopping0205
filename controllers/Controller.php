<?php
class Controller{
    static function loadView(string $view = 'index'){
        require_once 'views/master.view.php';
    }
    function error404(){
        return Controller::loadView('404');
    }
}


?>