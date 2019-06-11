<?php
class Controller{
    static function loadView(string $view = 'index', $title="Home Page"){
        require_once 'views/master.view.php';
    }
    function error404(){
        return Controller::loadView('404', "404 Not Found!");
    }
}


?>