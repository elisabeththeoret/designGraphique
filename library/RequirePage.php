<?php
    // class RequirePage
    class RequirePage{

        /**
         * requireModel
         * Lier un fichier 
         * @param { String } $model - Nom du modèle de la page
         */
        static function requireModel($model){
            return require_once("models/$model.php");
        }

        /**
         * redirectPage
         * Redirection de page
         * @param { String } $page - Nom de la page
         */
        static public function redirectPage($page){
            return header("Location: http://localhost/582-31B_prog_web_avancee/designGraphique$page");   // maison
            // return header("Location: http://localhost:7080/e2196008/designGraphique$page");   // ecole
        }

    }
?>

