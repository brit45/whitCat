<?php

class User_Controllers extends Controllers{

    function index() {

        $this->loadModel('User');
        $d['user'] = $this->User->Find([]);
        $this->set_Title("Test2 - Home");
        $this->set_Script('javascript','app.js');

        $this->Set($d);
        $this->Render();
    }

    function edit($pass = '') {
        $this->set_Title("Test2 - Edition");
        if($pass == '') {$this->e403('Erreur : Suite à une mauvaise manipulation, aucune information ne peut étre rendue.');}
        $this->loadModel('User');
        $d['info'] = $this->User->Find([
            'field' => [
                'nom',
                'prenom',
                'age',
                'genre',
                'taille',
                'poid'
            ],
            'condition' => [
                'pass' => $pass
            ]
        ]);
        $this->Set($d);
        $this->Render();
    }

    function Delect() {
        if(strtoupper($_POST['method']) == strtoupper('delete')) {
            $this->loadModel('User');
            $this->User->delect([
                'condition' =>[
                    'pass' => $_POST['id-content']
                ]
            ]);
        }
        else {
            $this->e500("La methode de utilisé n'est pas correcte.");
        }
    }

    function insert() {
        if(strtoupper($_POST['method']) == strtoupper('input/data')) {
            $genre = '';

            if(!empty($_POST['us-avatar'])) {
                $file = DATA.time().'.'.explode("/",$_FILES['us-avatar']['type'])[1];
                move_uploaded_file($_FILES['us-avatar']['tmp_name'], $file);
                $avatar = base64_encode(file_get_contents($file));
                unlink($file);
            }
            else {

                // Feminin
                if($_POST['us-genre'] == 'f') {
                    switch(rand(1,2)) {
                        case 1:
                            $avatar = base64_encode(file_get_contents(DATA.'profilF(1).png'));
                        break;

                        case 2:
                            $avatar = base64_encode(file_get_contents(DATA.'profilF(2).png'));
                        break;
                    }

                    $genre = 0;
                }

                

                // Masculin
                if($_POST['us-genre'] == 'm') {
                    $avatar = base64_encode(file_get_contents(DATA.'profilM.png'));
                    $genre = 1;
                }
            }

            if(!empty($_POST['us-nom'])) {
                $nom = $_POST['us-nom'];
            }
            else {
                return false;
            }
            if(!empty($_POST['us-prenom'])) {
                $prenom = $_POST['us-prenom'];
            }
            else {
                return false;
            }
            if(!empty($_POST['us-age']) && is_numeric($_POST['us-age'])) {
                $age = $_POST['us-age'];
            }
            else {
                return false;
            }
            if(!empty($_POST['us-taille']) && is_numeric($_POST['us-taille'])) {
                $taille = $_POST['us-taille'];
            }
            else {
                return false;
            }
            if(!empty($_POST['us-poid']) && is_numeric($_POST['us-poid'])) {
                $poid = $_POST['us-poid'];
            }
            else {
                return false;
            }

            $this->loadModel('User');
            $this->User->Insert([
                'condition' => [
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'age' => $age,
                    'genre' => $genre,
                    'taille' => $taille,
                    'picture' => $avatar,
                    'poid' => $poid,
                    'login' => password_hash($_POST['us-login'],CRYPT_MD5),
                    'pass' => sha1($_POST['us-pass'].time())
                ]
            ]);

            sleep(1);
            header('location: /');

        }
        else {
            $this->Render();
        }        
    }

};