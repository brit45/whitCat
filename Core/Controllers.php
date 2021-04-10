<?php

class Controllers extends Dispatcher {

    public string $controller;
    public string $action;
    public array $params = [];
    public  $vars = [];

    public function __construct($link = null) {
        if($this->rendered === true) {return false;}

        $this->controller = $link->controllers;
        $this->action = $link->action;
        $this->params = $link->params;
    }

    /**
     * > Permet de passé des variables à la vue
     * 
     * @param array $a tableau associatif avec clés et valeur
     * 
     * ou
     * 
     * @param string $a valeur
     * @param string $key Clé de la valeur
     * 
     * @return array return the name of array as super variable
     */
    public function Set($a, $key = null) {
        if(is_array($a)) {
            return $this->vars = $a;
        }
        else {
            return $this->vars[$key] = $a;
        }
    }


    /**
     * > Affiche la vue du controller
     * @return \Controller::Layout\[...]
     */
    public function Render() {
        extract($this->vars);
        require LAYOUT.ucfirst($this->controller).DS.$this->action.'.php';
    }

    /**
     * > Crée la connection au model
     * @param string $model Nom du model
     * @return \Model
     */
    public function loadModel($model) {
        require MODEL.$model."_Model.php";
        $m = $model;
        return $this->$model = new $m();
    }    


};