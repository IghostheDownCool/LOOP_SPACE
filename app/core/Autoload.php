<?php

spl_autoload_register(function ($class) {
    $directories = [
        __DIR__,
        __DIR__ . '/../core',
        __DIR__ . '/../controllers',
        __DIR__ . '/../controllers/admin',
        __DIR__ . '/../models',
        __DIR__ . '/../helpers',
    ];

    foreach ($directories as $directory) {
        $file = $directory . '/' . $class . '.php';
        if (is_file($file)) {
            require_once $file;
            return;
        }
    }
});