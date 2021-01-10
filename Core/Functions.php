<?php



function debug($expr) {
    
    require_once CONFIG.'Configuration.php';

    if(Config::$conf['Debug'] === true) {
        echo '<style type="text/css">';
        require_once ROOT.DS.'Debug/style-debug.css';
        echo '</style>';

        echo '<pre>';
        print_r($expr);
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