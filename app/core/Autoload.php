<?php

spl_autoload_register(function ($class) {

    $directories = [
        __DIR__,
        __DIR__ . '/../controllers',
        __DIR__ . '/../controllers/admin',
        __DIR__ . '/../models',
        __DIR__ . '/../helpers',
        __DIR__ . '/../services',
        __DIR__ . '/../repositories',
    ];

    foreach ($directories as $directory) {

        $file = $directory . '/' . $class . '.php';

        if (is_file($file)) {
            require_once $file;
            return;
        }
    }
});