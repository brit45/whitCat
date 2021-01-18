<?php

require '../Core/Includes.php';

if(file_exists(ROOT.'vendor/autoload.php')) {
    require_once ROOT.'vendor/autoload.php';
}

$MVC = new Dispatcher();

/**
 * 
 * SITE EN MVC, MODIFICATION DANS LES DOSSIERS [ CONTROLLER, LAYOUT ]
 * 
 */