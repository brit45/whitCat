<?php


include_once "routes.php";

class Config {

    static public $conf;
    
    static function loadConf($conf) {
        self::$conf = $conf;
    }
};

function loadFile(string $link) {

    $y = json_decode(file_get_contents($link.'.json'),true);
    
    foreach($y as $k => $v) {

        if(preg_match_all("/([@])([a-zA-Z0-9\/.]+)/",$v,$match,PREG_SET_ORDER)) {

            if($l = file_get_contents(CONFIG.$match[0][2].'.json',true)) {
                $y[$k] = json_decode($l,true,1024);
            }
        }
        
        foreach($v as $ke => $va) {

            if(preg_match_all("/([@])([a-zA-Z0-9\/.]+)/",$va,$match,PREG_SET_ORDER)) {

                if($le = file_get_contents(CONFIG.$match[0][2].'.json',true)) {
                    $k[$ke] = json_decode($le,true,1024);
                }
            }
        }
    }
    return (array) $y;
}


Config::loadConf(loadFile(CONFIG.'config'));