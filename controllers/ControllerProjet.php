<?php
    // fichiers
    RequirePage::requireModel('CRUD');
    RequirePage::requireModel('ModelProjet');
    RequirePage::requireModel('ModelClient');
    RequirePage::requireModel('ModelCategorie');

    // class ControllerProjet
    class ControllerProjet{

        /**
         * index
         * Afficher la première page qui liste les projets.
         * Déclarer les variables qu'on veut accessible dans la page.
         */
        public function index(){
            $projet = new ModelProjet();
            $selectProjets = $projet->selectProjets();
            
            twig::render("projet-index.php", ['projets' => $selectProjets]);
        }

        /**
         * show
         * Afficher les données du projet.
         * @param { Int } $id - Clé primaire du projet à afficher
         */
        public function show($id){
            $projet = new ModelProjet();
            $selectProjet = $projet->selectProjetId($id);
            
            twig::render("projet-show.php", ['projet' => $selectProjet]);
        }

        /**
         * create
         * Afficher la page pour créer un projet.
         */
        public function create(){
            $client = new ModelClient();
            $selectClients = $client->select();
            
            $categorie = new ModelCategorie();
            $selectCategories = $categorie->select();
            
            twig::render('projet-create.php', ['clients' => $selectClients, 'categories' => $selectCategories]);
        }

        /**
         * store
         * Enregistrer un nouveau projet.
         */
        public function store(){
            $projet = new ModelProjet();
            $insert = $projet->insert($_POST);
            
            requirePage::redirectPage('/projet/show/'.$insert);
        }

        /**
         * edit
         * Afficher les données d'un projet dans un formulaire pour les modifier.
         * @param { Int } $id - Clé primaire du projet à afficher
         */
        public function edit($id){
            $projet = new ModelProjet();
            $selectProjet = $projet->selectId($id);
            
            $client = new ModelClient();
            $selectClients = $client->select();
            
            $categorie = new ModelCategorie();
            $selectCategories = $categorie->select();
            
            twig::render('projet-edit.php', ['projet' => $selectProjet, 'clients' => $selectClients, 'categories' => $selectCategories]);
        }

        /**
         * update
         * Mettre à jour les données d'un projet.
         * @param { Int } $id - Clé primaire du projet à modifier
         */
        public function update(){
            $projet = new ModelClient();
            $update = $projet->update($_POST);
            
            requirePage::redirectPage('/projet/show/'.$_POST['id']);
        }

    }
?>
