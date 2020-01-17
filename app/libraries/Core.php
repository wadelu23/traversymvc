<?php
/*
    *App Core Class
    *Creates URL & loads core controller
    *URL FORMAT - /controller/method/params
*/
class Core {
    protected $currenController = 'Pages';
    protected $currenMethod = 'index';
    protected $params = [];

    public function __construct(){
        // print_r($this->getUrl());
        $url = $this->getUrl();

        // Look in controller for first value
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            // If exists, set as controller
            $this->currenController = ucwords($url[0]);
            //Unset 0 Index
            unset($url[0]);
        }
        //Require the controller
        require_once '../app/controllers/'. $this->currenController.'.php';
        //Instantiate controller class
        $this->currenController = new $this->currenController;
        
        //Check for second part of url
        if(isset($url[1])){
            //Check to see if method exists in controller
            if(method_exists($this->currenController, $url[1])){
                $this->currenMethod = $url[1];
                // Unset 1 index
                unset($url[1]);
            }
        }
        //Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currenController, $this->currenMethod], $this->params);

    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
