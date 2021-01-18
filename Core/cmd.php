<?php
require_once "Includes.php";



/**
 * Gestion du site depuis la ligne de commande.
 */
unset($argv[0]);
array_slice($argv, 1);

for($i = 1; $i < sizeof($argv); $i++) {
    $argv[$i] = strtolower($argv[$i]);
}

function rrmdir($dir) {
    if (is_dir($dir)) { // si le paramètre est un dossier
        $objects = scandir($dir); // on scan le dossier pour récupérer ses objets
        foreach ($objects as $object) { // pour chaque objet
             if ($object != "." && $object != "..") { // si l'objet n'est pas . ou ..
                  if (filetype($dir."/".$object) == "dir") rmdir($dir."/".$object);else unlink($dir."/".$object); // on supprime l'objet
                 }
        }
        reset($objects); // on remet à 0 les objets
        return rmdir($dir); // on supprime le dossier
    }
}


if(empty($argv) || $argv[1] == "help" || $argv[1] == "h") {
    echo "
     ===================================================================================
    |                                                                                   |
    |         WildSite   Ver. 1.1.0                                                     |
    |                                                                                   |
    |  *  \033[32;1mg \033[34;1mcontroller\33[0m + nom_du_controller : Génere un controller                       |
    |  *  \033[32;1mg \033[34;1mmodel\33[0m + nom_du_model           : Génere un Model                            |
    |  *  \033[31;1mdestroy \033[34;1mcontroller\33[0m + nom_du_controller : Détruis un controller                |
    |  *  \033[31;1mdestroy \033[34;1mmodel\33[0m + nom_du_model : Détruis un model                               |
    |  *  \033[32;1mlist \033[34;1mconfig\33[0m : Affiche la configuration                                        |
    |  *  \033[32;1mlist \033[34;1mrouter\33[0m : Affiche les routes                                              |
    |                                                                                   |
    |                                                                                   |
     ===================================================================================\n\n";
    die();
}

$timestamp = time();
$date = date('d/m/Y H:i`s', $timestamp);
$name = !empty($argv[3])?ucfirst($argv[3]):NULL;

if($argv[1] == "g" && $argv[2] == "controller") {

    
    $controller = "<?php

/**
 *  Crée le {$date}
 *  
*/ 

class {$name}_Controllers extends Controllers {


};
    ";
    if(!file_exists(CONTROLLER.$name."_Controllers.php")) {
       if(file_put_contents(CONTROLLER."{$name}_Controllers.php",$controller)) {
            echo "\033[32;1m *   Creation    \033[33mControllers/{$name}_Controllers.php\033[0m\n";
        } 
    }
    else {
        echo "\033[103;30;1m /!\\  Controller << $name >> already exists \033[0m\n";
    }
    
    if(!is_dir(LAYOUT.$name)) {
        if(mkdir(LAYOUT."{$name}",0777)) {
            echo "\033[32;1m *   Creation    \033[33mLayout/{$name}/\033[0m\n";
        }
    }
    else {
        echo "\033[103;30;1m /!\\  Layout << $name >> directory already exists \033[0m\n";
    }

}

if($argv[1] == "g" && $argv[2] == "model") {

    $model = "<?php
/**
 *  Crée le {$date}
 *  
*/ 

class {$name} extends Model {


};
    ";
    if(!file_exists(MODEL.$name."_Model.php")) {
        if(file_put_contents(MODEL."{$name}_Model.php",$model)) {
            echo "\033[32;1m *   Creation    \033[33mModel/{$name}_Model.php\033[0m\n";
        }
    }
    else {
        echo "\033[103;30;1m /!\\  Model << $name >> already exists \033[0m\n";
    }
    

}

if($argv[1] == "destroy" && $argv[2] == "controller") {
    if(is_dir(LAYOUT.$name)) {
        if(rrmdir(LAYOUT.$name)) {
            echo "\033[32;1m *   Suppression    \033[33;4mLayout/{$name}/\033[0m\n";
        }
    }
    else {
        echo "\033[41;1m /!\\   Suppression impossible directory not found \033[0m\n";
    }
    
    if(file_exists(CONTROLLER.$name."_Controllers.php")) {
        if(unlink(CONTROLLER.$name."_Controllers.php")) {
            echo "\033[32;1m *   Suppression    \033[33;4mController/{$name}_Controllers.php\033[0m\n";
        }
    }
    else {
        echo "\033[41;1m /!\\   Suppression impossible file not found \033[0m\n";
    }
}

if($argv[1] == "destroy" && $argv[2] == "model") {
    if(file_exists(MODEL.$name."_Model.php")) {
        if(unlink(MODEL.$name."_Model.php")) {
            echo "\033[32;1m *   Suppression    \033[33;4mModel/{$name}_Model.php\033[0m\n";
        }
    }
    else {
        echo "\033[41;1m /!\\   Suppression impossible file not found \033[0m\n";
    }
}

if($argv[1] == "list" && $argv[2] == "config") {
    $i = 15;
    foreach(Config::$conf as $k=>$v) {
        $spaces = tableur_cmd($k, "|", $i);
        if(!is_array($v)) {
            echo "  $k ".$spaces." $v\n";
        }
        else {
            foreach($v as $ke=>$va) {
                $spaces = tableur_cmd($ke, "|", $i);
                if(!is_array($va)) {
                    echo "  $ke ".$spaces." $va\n";
                }
                else {
                    foreach($va as $l=>$n) {
                        $fr[] = "\033[42;30m$l : $n\033[0m";
                    }

                    $sa = implode(", ",$fr);
                    echo "  $ke ".$spaces." ".$sa."\n";
                }
            }
        }
    }
}



if($argv[1] == "list" && $argv[2] == "router") {
    echo "\nROUTER URL\n\n";
    foreach(Router::$url as $k=>$v) {
        echo "$k :\n";
        foreach($v as $ke=>$va) {
            $spaces = tableur_cmd($ke, "#", 15);
            echo "  $ke ".$spaces." $va\n";
        }
        echo "\n";
    }
}