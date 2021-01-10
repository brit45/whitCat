<?php

class Sessions {

    public function __construct() {
        if(!isset($_SESSION)) {
            session_start();   
        }

        if(empty($_SESSION)) {
            $_SESSION = [
                'TOKEN_TIME_ID' => hash('sha256',time()),
                'TIME_CREATED' => time()
            ];
        }

        if(strtotime($_SESSION['TIME_CREATED'], '+3weeks') >= time()) {
            session_destroy();
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
};