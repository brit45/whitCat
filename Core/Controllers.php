<?php

class Controllers extends Dispatcher {

    public $controller;
    public $action;
    public $params = [];
    public $vars = [];

    public function __construct($link = null) {
        if($this->rendered === true) {return false;}

        $this->controller = $link->controllers;
        $this->action = $link->action;
        $this->params = $link->params;
    }

    public function Set($a, $key = null) {
        if(is_array($a)) {
            return $this->vars = $a;
        }
        else {
            return $this->vars[$key] = $a;
        }
    }

    public function Render() {
        extract($this->vars);
        require LAYOUT.ucfirst($this->controller).DS.$this->action.'.php';
        
    }

    public function loadModel($model) {
        require MODEL.$model."_Model.php";
        $m = $model;
        $this->$model = new $m();
    }    

};