<?php
    // Class Twig
    class Twig{

        /**
         * render
         * Afficher la page modèle reçu et envoyer les données, s'il y en a.
         * @param { String } $template - Nom du fichier à afficher
         * @param { Array } $data - Données à envoyer à la page
         */
        static public function render($template, $data = array()){
            $loader = new \Twig\Loader\FilesystemLoader('views');
            $twig = new \Twig\Environment($loader, array('auto_reload' => true, 'cache' => false));
            
            // variables globales
            // $twig->addGlobal('path', 'http://localhost/582-31B_prog_web_avancee/designGraphique');   // maison
            $twig->addGlobal('path', 'http://localhost:7080/e2196008/designGraphique');              // ecole
            $twig->addGlobal('session', $_SESSION);
            
            if(isset($_SESSION['fingerPrint']) && $_SESSION['fingerPrint'] === md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])){
                $guest = false;
            } else{
                $guest = true;
            }
            $twig->addGlobal('guest', $guest);
            
            echo $twig->render($template, $data);
        }

    }

?>
