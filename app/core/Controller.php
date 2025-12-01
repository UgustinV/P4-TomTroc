<?php

class Controller
{
    public function __construct()
    {
        print_r('Base Controller Loaded ');
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
}