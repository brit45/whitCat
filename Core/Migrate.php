<?php

class Blueprint {

    public $val = [];

    public function id() {
        return $this->val[] = 'id INT PRIMARY KEY NOT NULL AUTO_INCREMENT';
    }

    public function text($i) {
        return $this->val[] = "$i TEXT";
    }

    public function bool($i) {
        return $this->val[] = "$i BOOLEAN";
    }

    public function varchar($i,$n) {
        return $this->val[] = "$i VARCHAR($n)";
    }

    public function date($i) {
        return $this->val[] .= "$i DATE";
    }

    public function int($i) {
        return $this->val[] = "$i INT";
    }

    public function read() {
        return (string) $r =implode(' ,', $this->val);
    }

}

class Migrate extends Model {

    protected $sql;
    public $data;


    function up() {}

    
    function create($N_table, Blueprint $t) {

        $data = Config::$conf['DataBase']['DataBase_Name'];


        $this->sql = "CREATE TABLE IF NOT EXISTS $data.$N_table ({$t->read()})";
        
        echo $this->sql;
    }

}