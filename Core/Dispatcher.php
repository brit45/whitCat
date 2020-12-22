<?php

class Dispatcher {

    public $vars = [];
    public $route;
    public bool $rendered = false;

    public $head;
    public $title;
    public $script;

    public function __construct() {
        
        Router::path();
        $route = Router::$Route;
        foreach($route as $k=>$v) {
            $this->route->$k = $v;
        }
        
        $Controllers = ucfirst($this->route->controllers).'_Controllers';
        $action = $this->route->action;

        if($Controllers == ucfirst('var').'_Controllers') {return;}

        require 'Controllers.php';

        if(file_exists(CONTROLLER.$Controllers.'.php')) {
            require CONTROLLER.$Controllers.'.php';
        }
        else {
            $this->e404("La page demandé < <font class='text-danger text-uppercase fw-bold'>{$this->route->controllers}</font> > n'éxiste pas.");
        }
        
        
        $this->controller = new $Controllers($this->route);
        $metod = get_class_methods($this->controller);

        if(!in_array($this->route->action,array_diff($metod,get_class_methods('Controllers')))) {
            $this->e404('Error : La page demandé < <font class="text-danger text-uppercase fw-bold">'.$this->route->action.'</font> > n\'éxiste pas.');
        }

        ob_start();
            call_user_func_array([$this->controller, $action],$this->route->params);
            
            ob_start();
                $this->controller->Generate_Head();
            $content_to_head = ob_get_clean();
            
        $content_to_htm = ob_get_clean();
        

        require LAYOUT.'View/'.Config::$conf['Layout_Default'].'.php';

        $this->rendered = true;
    }

    public function set_Title($title) {
        $this->title = $title;
    }

    public function set_Script($type,$script,$action = "defer") {
        $this->script[] = [
            "type" => $type,
            "script" => $script,
            "action" => $action
        ];
    }

    public function Generate_Head() {
        echo "<title>{$this->title}</title>\n";

        foreach($this->script as $k=>$v) {
            $s = file_get_contents(WEB_ROOT.'Js/'.$v['script']);
            echo "\n<script src=\"data:text/{$v['type']};base64,".base64_encode($s)."\" {$v['action']}></script>\n";
        }
    }

    // Gestion des Erreurs ou permission (Affichage utilisateur)

    // Erreur 404 - NOT FOUND 
    public function e404($message) {

        header('404 NOT FOUND',true,404);

        ob_start();
        
        require_once LAYOUT.'Error/e404.php';

        $content_to_htm = ob_get_clean();

        require LAYOUT.'View/'.Config::$conf['Layout_Default'].'.php';

        die();
        
    }

    // Erreur 500 - ERREUR SERVER
    public function e500($message) {

        header('500 SERVER ERROR',true,500);

        ob_start();
        
        require_once LAYOUT.'Error/e500.php';

        $content_to_htm = ob_get_clean();

        require LAYOUT.'View/'.Config::$conf['Layout_Default'].'.php';

        die();

    }

    // Erreur 301 - REDIRECT PERMANENTLY
    public function e301($message) {

        ob_start();

        require_once LAYOUT.'Error/e301.php';

        $content_to_htm = ob_get_clean();

        require LAYOUT.'View/'.Config::$conf['Layout_Default'].'.php';

        die();

    }

    // Erreur 403 - ACCESS DENIED 
    public function e403($message) {

        header('HTTP/1.1 403 ACCESS DENIED',true,403);

        ob_start();
        
        require_once LAYOUT.'Error/e403.php';

        $content_to_htm = ob_get_clean();

        require LAYOUT.'View/'.Config::$conf['Layout_Default'].'.php';

        die();
        
    }
};