#!/usr/bin/php
<?php
require_once "Includes.php";

/**
 * Gestion du site depuis la ligne de commande.
 */

function rrmdir($dir)
{
    if (is_dir($dir)) { // si le paramètre est un dossier
        $objects = scandir($dir); // on scan le dossier pour récupérer ses objets
        foreach ($objects as $object) { // pour chaque objet
            if ($object != "." && $object != "..") { // si l'objet n'est pas . ou ..
                if (filetype($dir . "/" . $object) == "dir") rmdir($dir . "/" . $object);
                else unlink($dir . "/" . $object); // on supprime l'objet
            }
        }
        reset($objects); // on remet à 0 les objets
        return rmdir($dir); // on supprime le dossier
    }
}


function p_help($a)
{
    echo "\n#####################################\n";
    foreach ($a as $k => $v) {
        $v = preg_replace('/([_])/', ':', $v);
        echo "$v\n";
    }

    die();
}

function file_controller($name, $date)
{
    $controller = "<?php

/**
 *  Crée le {$date}
 *  
*/ 

class {$name}_Controllers extends Controllers {


};
    ";
    if (!file_exists(CONTROLLER . $name . "_Controllers.php")) {
        if (file_put_contents(CONTROLLER . "{$name}_Controllers.php", $controller)) {
            echo "\033[32;1m *   Creation    \033[33mControllers/{$name}_Controllers.php\033[0m\n";
        }
    } else {
        echo "\033[103;30;1m /!\\  Controller << $name >> already exists \033[0m\n";
    }

    if (!is_dir(LAYOUT . $name)) {
        if (mkdir(LAYOUT . "{$name}", 0777)) {
            echo "\033[32;1m *   Creation    \033[33mLayout/{$name}/\033[0m\n";
        }
    } else {
        echo "\033[103;30;1m /!\\  Layout << $name >> directory already exists \033[0m\n";
    }
}

function file_model($name, $date)
{

    $model = "<?php
/**
 *  Crée le {$date}
 *  
*/ 

class {$name} extends Model {


};
    ";
    if (!file_exists(MODEL . $name . "_Model.php")) {
        if (file_put_contents(MODEL . "{$name}_Model.php", $model)) {
            echo "\033[32;1m *   Creation    \033[33mModel/{$name}_Model.php\033[0m\n";
        }
    } else {
        echo "\033[103;30;1m /!\\  Model << $name >> already exists \033[0m\n";
    }
}

function del_controller($name)
{
    if (is_dir(LAYOUT . $name)) {
        if (rrmdir(LAYOUT . $name)) {
            echo "\033[32;1m *   Suppression    \033[33;4mLayout/{$name}/\033[0m\n";
        }
    } else {
        echo "\033[41;1m /!\\   Suppression impossible directory not found \033[0m\n";
    }

    if (file_exists(CONTROLLER . $name . "_Controllers.php")) {
        if (unlink(CONTROLLER . $name . "_Controllers.php")) {
            echo "\033[32;1m *   Suppression    \033[33;4mController/{$name}_Controllers.php\033[0m\n";
        }
    } else {
        echo "\033[41;1m /!\\   Suppression impossible file not found \033[0m\n";
    }
}

function del_model($name)
{

    if (file_exists(MODEL . $name . "_Model.php")) {
        if (unlink(MODEL . $name . "_Model.php")) {
            echo "\033[32;1m *   Suppression    \033[33;4mModel/{$name}_Model.php\033[0m\n";
        }
    } else {
        echo "\033[41;1m /!\\   Suppression impossible file not found \033[0m\n";
    }
}

function list_conf()
{
    $i = 15;
    foreach (Config::$conf as $k => $v) {
        $spaces = tableur_cmd($k, "|", $i);
        if (!is_array($v)) {
            echo "  $k " . $spaces . " $v\n";
        } else {
            foreach ($v as $ke => $va) {
                $spaces = tableur_cmd($ke, "|", $i);
                if (!is_array($va)) {
                    echo "  $ke " . $spaces . " $va\n";
                } else {
                    foreach ($va as $l => $n) {
                        $fr[] = "\033[42;30m$l : $n\033[0m";
                    }

                    $sa = implode(", ", $fr);
                    echo "  $ke " . $spaces . " " . $sa . "\n";
                }
            }
        }
    }
}



function list_route()
{
    echo "\nROUTER URL\n\n";
    foreach (Router::$url as $k => $v) {
        echo "$k :\n";
        foreach ($v as $ke => $va) {
            $spaces = tableur_cmd($ke, "|", 8);
            echo "  $ke " . $spaces . " $va\n";
        }
        echo "\n";
    }
}

class CMD
{
    public $command = null;
    public $method = null;
    public $action = null;
    public $params = null;

    public function __construct($t)
    {

        $this->timestamp = time();
        $this->date = date('d/m/Y H:i`s', $this->timestamp);
        $m = get_class_methods(CMD::class);
        $this->method = array_splice($m, 1);

        $t = array_splice($t, 1);

        if (empty($t)) {
            return $this->help();
        }

        $this->action = preg_replace('/([:])/', '_', $t[0]);
        $this->params = array_splice($t, 1);
        unset($t);


        call_user_func_array([CMD::class, $this->action], $this->params);
    }

    // HELP
    public function help()
    {
        return p_help($this->method);
    }

    /**
     * Crée un controller
     */
    public function make_controller($t)
    {
        return file_controller(ucfirst($t), $this->date);
    }

    /**
     * Crée un model
     */
    public function make_model($t)
    {
        return file_model(ucfirst($t), $this->date);
    }

    /**
     * Detruit un controller
     */
    public function delete_controller($t)
    {
        return del_controller(ucfirst($t));
    }

    /**
     * Detruit un model
     */
    public function delete_model($t)
    {
        return del_model(ucfirst($t));
    }

    /**
     * Liste la configuration
     */
    public function list_config()
    {
        return list_conf();
    }

    /**
     * Liste les routes
     */
    public function list_router()
    {
        return list_route();
    }
}

$_ = new CMD($argv);
unset($_);
