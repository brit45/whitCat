<?php

class Router {

    public static $Route = [];
    public static $url = [];
    public static $hook = [];
    public static $prefix;
    public static stdClass $post;

    public static function path() {

        $link = $_SERVER['REQUEST_URI'];

        if(preg_match("([a-zA-Z0-9\/.-_]+).json/",$link)) {
            header('location: /');
        }

        $link = trim($link,'/');
        $link = explode('/', $link);

        foreach(self::$hook as $k=>$v) {
            if($link[0] == $k) {
                self::$prefix = $v;
                $link = array_splice($link,1);
            }
        }
        
        foreach(self::$url as $k=>$v) {
            if($v['orig'] == $link[0]) {
                $r['orig'] = $v['link'].implode('/',array_slice($link,1));
                break;
            }
            else {
                $r['orig'] = implode('/',$link);
            }            
        }

        $r['match'] = explode('/', $r['orig']);

        $r['controllers'] = $r['match'][0];
        $r['action'] = !empty(self::$prefix)?self::$prefix.$r['match'][1]:$r['match'][1];
        $r['params'] = array_slice($r['match'],2);

        unset($r['orig'], $r['match']);
        
        return self::$Route = $r;
    }

    /**
     * @param string $name constante dans les pages
     * @param string $orig rendue des lien au propre
     * @param string $link lien réel vers les pages.
     */
    public static function Route($name,$orig,$link): array {
        return self::$url[] = [
            'name' => $name,
            'orig' => $orig,
            'link' => $link
        ];
    }

    public static function RPatch($orig) {
        foreach(self::$url as $k=>$v) {
            if($v['name'] == $orig) {
                return $v['orig'];
            }
        }
    }
    
    public static function Post() {
        if(isset($_POST) == !empty($_POST)) {

            foreach($_POST as $k=>$v) {
                self::$post->$k = $v;
            }
            return self::$post;
        }
    }

    public static function Hook($key, $action) {
        return self::$hook += [$key => $action];
    }

};