<?php

function class_auto_loader($className)
{
    $parts = explode('\\', $className);
    $path = './src/' . implode('/', $parts) . '.php';
    if(file_exists($path)) {
        require_once($path);
    }
}

spl_autoload_register('class_auto_loader');