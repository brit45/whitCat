<?php

class Model {
    
    public $instance;
    public string $SQL;
    public string $table;

    
    public function __construct() {
        
        if(!empty($this->instance)) {return true;}

        $this->table = get_class($this);

        require_once CONFIG.'Configuration.php';
        $info = Config::$conf['DataBase'];
        $this->instance = new PDO($info['DataBase_Type'].':host='.$info['DataBase_Addr'].';dbname='.$info['DataBase_Name'],
            $info['DataBase_Login'],$info['DataBase_Pass']
        );

        foreach($info['DataBase_OPtion'] as $k=>$v) {
            $this->instance->setAttribute($k,$v);
        }
    }

    public function Find($req) {

        $sql = "SELECT ";

        if(isset($req['field'])) {
            if(is_array($req['field'])) {
                $sql .= implode(", ",$req['field']);
            }
            else {
                $sql .= $req['field'];
            }
        }
        else {
            $sql .= '*';
        }

        $sql .= ' FROM '.strtolower($this->table).' ';

        if(isset($req['condition'])) {
            $sql .= 'WHERE ';
            if(!is_array($req['condition'])) {
                $sql .= $req['condition'];
            }
            else {
                $cond = [];
                foreach($req['condition'] as $k=>$v) {
                    if(is_numeric($v)) {
                        $v = htmlentities($this->instance->quote($v));
                    }
                    else {
                        $v = htmlentities($this->instance->quote($v));
                    }
                    $cond[] = "$k=$v";
                }
                $sql .= implode(' AND ', $cond);
            }
        }

        if(isset($req['order'])) {
            $sql .= ' ORDER BY '.$req['order'];
        }

        if(isset($req['limit'])) {
            $sql .= ' LIMIT '.$req['limit'];
        }

        $pre = $this->instance->prepare($sql);
        $pre->execute();
        
        $this->SQL = $sql;

        return $pre->fetchAll(PDO::FETCH_OBJ);
    }

    public function delect($req) {
        $sql = "DELETE ";
        
        $sql .= ' FROM '.strtolower($this->table).' ';

        if(isset($req['condition'])) {
            $sql .= 'WHERE ';
            if(!is_array($req['condition'])) {
                $sql .= $req['condition'];
            }
            else {
                $cond = [];
                foreach($req['condition'] as $k=>$v) {
                    if(is_numeric($v)) {
                        $v = htmlentities($this->instance->quote($v));
                    }
                    else {
                        $v = htmlentities($this->instance->quote($v));
                    }
                    $cond[] = "$k=$v";
                }
                $sql .= implode(' AND ', $cond);
            }
        }
        $pre = $this->instance->prepare($sql);
        $pre->execute();

        $this->SQL = $sql;
            
    }

    public function Insert($req) {
        $sql = "INSERT INTO ";
        $sql .= strtolower($this->table).' ';

        if(isset($req['condition'])) {
            $sql .= 'SET ';
            $cond = [];
            foreach($req['condition'] as $k=>$v) {
                $kt = ucfirst($k);
                $cond[] = "$k=:$kt";
                $d["$kt"] = "$v";
            }

            $sql .= implode(', ', $cond);

            $pre = $this->instance->prepare($sql);
            $pre->execute($d);

            $this->SQL = $sql;
        }
    }
};