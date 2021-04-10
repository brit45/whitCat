<?php

class Sessions {

    private $token_time_id;
    private $token_created;
    public  $created = false;
    public  $vals;

    public function __construct() {
        if(!isset($_SESSION)) {
            session_start();   
        }
    }

    public function setFlash($msg,$type = 'success') {
        $_SESSION['flash']['msg'] =  $msg;
        $_SESSION['flash']['type'] =  $type;
    }

    public function Flash() {
        echo "<div class='bg-{$_SESSION['flash']['type']}'>
            <p>{$_SESSION['flash']['msg']}</p>
        </div>";
        unset($_SESSION['flash']);
    }

    public function setSession(array $k) {
        $this->token_time_id = 'TOKEN.ID.SECURITY.VALIDATE_::{'.hash('sha256',time()).'}';
        $this->token_created = time();
        $this->vals = $k;
        $_SESSION['conn'] = [
            'token_created' => $this->token_created,
            'security_token' => $this->token_time_id
        ]+$this->vals;
        $this->created = true;
        return $this->token_time_id;
    }

    public function getSession() {
        return $_SESSION['conn'];
    }
};