<?php



function debug($expr) {
    
    require_once CONFIG.'Configuration.php';

    if(Config::$conf['Debug'] === true) {
        echo '<style type="text/css">';
        require_once ROOT.DS.'Debug/style-debug.css';
        echo '</style>';

        echo '<pre>';
        strip_tags(print_r($expr));
        echo '</pre>';
    }
}

function tableur_cmd($k, $ch, $int = 40) {
    $char = strlen($k);
    $blank = $int;

    $space = $blank - $char;

    $spaces = "";

    for($i = $space; $i > 0; $i--) {
        $spaces .= " ";
    }
    return $spaces .= "$ch ";
}

/**
 * Detect une connection depuis TOR
 */
function IsTorInside(){
    
    if(gethostbyname(ReverseIP($_SERVER['REMOTE_ADDR']).".dnsel.torproject.org")=="127.0.0.2") {

        return true;
    }
    else { 
        return false;
    }
}

function ReverseIP($ip)
{
    $ipx = explode(".",$ip);
    return $ipx[3].".".$ipx[2].".".$ipx[1].".".$ipx[0];
}