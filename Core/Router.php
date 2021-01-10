<?php

class Router {

    public static $Route = [];
    public static $url = [];

    public static function path() {
        $r['orig'] = !empty($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:"index/home/params1/params2";

        $r['orig'] = trim($r['orig'],'/');
        $r['match'] = explode('/', $r['orig']);
        
        $r['controllers'] = !empty($r['match'][0])?$r['match'][0]:'index';
        $r['action'] = !empty($r['match'][1])?$r['match'][1]:'home';
        $r['params'] = array_slice($r['match'],2);

        unset($r['orig'], $r['match']);
        
        return self::$Route = $r;
    }

    public static function Route($name,$ressource) {
        self::$url[$name] = $ressource;
    }

    public static function RPatch($patch) {

        if(isset(self::$url[$patch]) && !empty(self::$url[$patch])) {
            return self::$url[$patch];
        }
        else {
            return $patch;
        }
        
    }

};