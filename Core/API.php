<?php 

class API {

    public $token;
    public $security_token;

    function __construct() {
        $this->security_token = Config::$conf['security']['token'];
        $this->token = Config::$conf['security']['public'];
        $this->post = Router::Post();
    }

    function New_Token() {

        if(!is_dir(ROOT.'/resource')) {
            mkdir(ROOT.'/resource');
            if(!is_dir(ROOT.'/resource/token')) {
                mkdir(ROOT.'/resource/token');
            }
        }

        $link = ROOT.'/resource/token/L_Token.access';

        $f = file_get_contents($link);
        $f = explode("\n",$f);
        $token = hash("sha256",$this->security_token.$this->token.date("d/m/Y").rand(0,5));
        $f[] = time().' '.$token." AAAA";
        $f = implode("\n", $f);
        file_put_contents(ROOT.'/resource/token/L_Token.access',$f);

        return (string) $token;

    }
    
}