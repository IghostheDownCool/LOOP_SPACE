<?php
class AdminHomeController extends AdminController
{
    public function index()
    {
        $this->view('admin/index');
    }
}