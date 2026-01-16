<?php

class LogoutController extends Controller
{
    public function index()
    {
        $this->logout();
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /P4-TomTroc/public/login');
        exit;
    }
}