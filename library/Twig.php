<?php
    // Class Twig
    class Twig{

        /**
         * render
         */
        static public function render($template, $data = array()){
            $loader = new \Twig\Loader\FilesystemLoader('views');
            $twig = new \Twig\Environment($loader, array('auto_reload' => true));
            $twig->addGlobal('path', 'http://localhost/582-31B_prog_web_avancee/designGraphique');

            echo $twig->render($template, $data);
        }
    }

?>

