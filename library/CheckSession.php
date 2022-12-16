<?php
    // Class CheckSession
    class CheckSession{

        /**
         * sessionAuth
         * Vérifier la session de l'utilisateur.
         */
        static public function sessionAuth(){
            // vérifier
            if(isset($_SESSION['fingerPrint']) and $_SESSION['fingerPrint'] === md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])){
                // ok
                return true;
            } else{
                // rediriger
                requirePage::redirectPage('/user/login');
            }
        }

    }
?>
