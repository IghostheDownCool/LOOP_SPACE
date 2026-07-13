<?php

class LogoutController extends Controller
{
    public function index()
    {
        session_unset();

        session_destroy();

        header('Location: /LOOP_SPACE/public/login');
        exit;
    }
}