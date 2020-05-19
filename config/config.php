<?php

const CLASSES_FOLDERS = [
    'models',
    'controllers',
];

spl_autoload_register(function ($className) {
    foreach(CLASSES_FOLDERS as $folder) {
        $file = __DIR__ . '/../src/' . $folder . '/' . $className . '.php';

        if( file_exists($file) ) {
            require $file;
        }
    }
});