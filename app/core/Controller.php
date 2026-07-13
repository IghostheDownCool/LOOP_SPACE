<?php

class Controller
{
    public function view(string $view, array $data = [])
    {
        extract($data);

        $file = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($file)) {
            require_once $file;
        } else {
            die("View '{$view}' não encontrada.");
        }
    }
}