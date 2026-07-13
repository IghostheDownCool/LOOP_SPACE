<?php

spl_autoload_register(function ($class) {

    $directories = [
        __DIR__,
        __DIR__ . '/../controllers',
        __DIR__ . '/../models',
        __DIR__ . '/../helpers',
    ];

    foreach ($directories as $directory) {

        $file = $directory . '/' . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});