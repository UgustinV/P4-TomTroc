<?php

spl_autoload_register(function($className) {
    // Get the absolute path to the app directory (where this autoload.php is located)
    $appDir = realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR;
    
    $directories = [
        'services',
        'models', 
        'controllers',
        'core'
    ];
    
    foreach ($directories as $dir) {
        $file = $appDir . $dir . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});