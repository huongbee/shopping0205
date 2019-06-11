<?php
class Controller{
    function loadView(string $view = 'index'){
        require_once '../views/master.view.php';
    }
}


?>