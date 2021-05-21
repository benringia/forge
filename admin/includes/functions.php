<?php

function class_auto_loader($class) {

    $class = strtolower($class);

    $path = "includes/$class.php";

    if(is_file($path) && !class_exists($class)) {

        require_once($path);
    }

}

spl_autoload_register('class_auto_loader');