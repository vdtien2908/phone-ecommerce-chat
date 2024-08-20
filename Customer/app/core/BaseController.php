<?php
class BaseController
{
    public function model($model)
    {
        require_once "./app/models/" . $model . ".php";
        return new $model;
    }

    public function view($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        require_once './app/core/function.php';
        $func = new Func; 
        $func->setRootPath();

        require_once "./app/views/layouts/" . $view . ".php";
    }
}
