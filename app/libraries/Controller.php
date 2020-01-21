<?php

/*
 * Base Controller
 * Loads the models and views
 */

class Controller{
    // Load model
    public function model($model){
        // Require model file
        require_once '../app/models/'.$model.'.php';
        return new $model();
    }

    // Load view
    public function view($view, $data = []){
        $file = '../app/views/'.$view.'.php';
        // Check for view file
        if(file_exists($file)){
            require_once $file;
        }else{
            die('View dose not exist');
        }
    }
}