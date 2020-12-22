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