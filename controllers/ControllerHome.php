<?php
    // class ControllerHome
    class ControllerHome{

        /**
         * index
         * Afficher la page d'accueil avec twig.
         */
        public function index(){
            twig::render("home-index.php");
        }

        /**
         * error
         * Afficher la page d'erreur avec twig.
         */
        public function error(){
            twig::render("home-error.php");
        }

    }
?>

