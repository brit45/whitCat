<?php

define("DS", "/");
define("ROOT", dirname(__DIR__));
define("WEB_ROOT", ROOT.DS."Web".DS);
define("CORE", ROOT.DS."Core".DS);
define("CONFIG", ROOT.DS."Config".DS);
define("DATA", ROOT.DS."Data".DS);
define("LOG", ROOT.DS."Log".DS);
define("CONTROLLER", ROOT.DS."Controller".DS);
define("LAYOUT", ROOT.DS."Layout".DS);
define("MODEL", ROOT.DS."Model".DS);

require CORE.'Includes.php';

$MVC = new Dispatcher();

/**
 * 
 * SITE EN MVC, MODIFICATION DANS LES DOSSIERS [ CONTROLLER, LAYOUT ]
 * 
 */