<?php

include_once "routes.php";

class Config {

    static public $conf;
    
    static function loadConf($conf) {
        self::$conf = $conf;
    }
};

Config::loadConf([

    "DataBase" => [

        "DataBase_Type"     => "mysql",

        // if Type is MySQL
        
        "DataBase_Login"    => null,
        "DataBase_Addr"     => null,
        "DataBase_Pass"     => null,
        "DataBase_Name"     => null,
        "DataBase_OPtion"   => [

            PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_SILENT,
            PDO::PARAM_STR_CHAR             => "utf-8"

        ],

        // ------------------

        // if Type is liteSQL

        "DataBase_Path"     => null

        // ------------------

    ],

    "Debug"             => true,
    "Layout_Default"    => "Default",
    "Layout_Admin"      => ""
]);
