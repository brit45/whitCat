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
define('RESOURCE',ROOT.DS.'resource'.DS);

require_once "Functions.php";

if(file_exists(ROOT.'vendor/autoload.php')) {
    require ROOT.'vendor/autoload.php';
    debug("Include Vendor Directory");
}

require_once "Sessions.php";
require_once "Router.php";
require_once CONFIG."Configuration.php";
require_once "Model.php";
require_once "Dispatcher.php";
require_once "Migrate.php";
require_once "API.php";