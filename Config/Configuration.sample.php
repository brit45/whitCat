<?php

$Configuration = [

    "DataBase" => [

        "DataBase_Type"     => "mysql",

        // if Type is MySQL
        
        "DataBase_Login"    => "",
        "DataBase_Addr"    => "",
        "DataBase_Pass"     => "",
        "DataBase_Name"     => "",
        "DataBase_OPtion"   => [

            PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_SILENT,
            PDO::PARAM_STR_CHAR             => "utf-8"

        ],

        // ------------------

        // if Type is liteSQL

        "DataBase_Path"     => ""

        // ------------------

    ],

    "Debug"             => true,
    "Layout_Default"    => "Default",
    "Layout_Admin"      => "Admin"
];

class Config {

    static public $conf;
    
    static function loadConf($conf) {
        self::$conf = $conf;
    }
};

Config::loadConf($Configuration);

Router::Route('', '/');