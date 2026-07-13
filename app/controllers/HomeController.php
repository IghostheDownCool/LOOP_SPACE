<?php

class HomeController extends Controller
{
    public function index()
    {
        $this->requireLogin();

        $this->view('home/index');
    }
}