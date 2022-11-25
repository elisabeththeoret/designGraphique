<?php
    // fichiers
    RequirePage::requireModel('CRUD');
    RequirePage::requireModel('ModelProjet');
    RequirePage::requireModel('ModelService');

    // class ControllerClient
    class ControllerProjet{

        /**
         * index
         * Afficher la première page qui liste les clients.
         * Déclarer les variables qu'on veut accessible dans la page.
         */
        public function index(){
            $projet = new ModelProjet();
            $selectProjets = $projet->select();

            twig::render("projet-index.php", ['projets' => $selectProjets]);
        }

    }
?>

