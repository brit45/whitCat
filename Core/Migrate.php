<?php

/**
 * Creation de le structure des tables **SQL**.
 */
class Model_Blueprint {

    public $val = [];

    /**
     * Clé de ref.
     */
    public function id() {
        return $this->val[] = 'id INT PRIMARY KEY NOT NULL AUTO_INCREMENT';
    }

    /**
     * Text
     * @param string $i nom.
     */
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

class Migrate {

    protected $sql;
    public $data;

    public function __construct() {
        $info = Config::$conf['DataBase'];
        $this->data = new PDO($info['DataBase_Type'].':host='.$info['DataBase_Addr'].';dbname='.$info['DataBase_Name'],
        $info['DataBase_Login'],$info['DataBase_Pass']);
        
    }

    /**
     * Applique les modification à la base de donnée.
     */
    public function up() {}
    
    /**
     * Annule les modification à la base de donnée.
     */
    public function down() {}

    /**
     * Rafraichie la table
     */
    public function refresh() {}

    /**
     * Crée le contenue de la table de BDD.
     */
    protected function create(string $N_table, Model_Blueprint $t) {

        $data = Config::$conf['DataBase']['DataBase_Name'];

        $this->sql = "CREATE TABLE IF NOT EXISTS {$data}.{$N_table} ({$t->read()})";
        
        echo $this->sql."\n";
        $p = $this->data->prepare($this->sql);
        $p->execute();
    }
    
    protected function delete(string $N_table) {
        
        $data = Config::$conf['DataBase']['DataBase_Name'];

        $this->sql = "DROP TABLE {$data}.{$N_table}";
        echo $this->sql."\n";

        $p = $this->data->prepare($this->sql);
        $p->execute();

    }
}