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
         * Déclarer les variables qu'on veut accessible dans la page.
         * Afficher la page de détails d'un projet.
         * @param { Int } $id - Clé primaire du projet à afficher
         */
        public function show($id){
            $projet = new ModelProjet();
            $selectProjet = $projet->selectProjetId($id);
            
            twig::render("projet-show.php", ['projet' => $selectProjet]);
        }

        /**
         * create
         * Afficher la page pour créer un nouveau projet.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent créer un nouveau projet.
         */
        public function create(){
            CheckSession::sessionAuth();
            
            // admin ou employé.e
            if($_SESSION['privilege_id'] <= 2){
                $client = new ModelClient();
                $selectClients = $client->select();
                
                $categorie = new ModelCategorie();
                $selectCategories = $categorie->select();
                
                twig::render('projet-create.php', ['clients' => $selectClients, 'categories' => $selectCategories]);
            }
            // client
            else{
                RequirePage::redirectPage('/home/error');
            }
        }

        /**
         * store
         * Valider les données reçues.
         * Enregistrer un nouveau projet.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent créer un nouveau projet.
         */
        public function store(){
            CheckSession::sessionAuth();
            
            // client
            if($_SESSION['privilege_id'] == 3){
                RequirePage::redirectPage('/home/error');
            }
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('titre')->value($titre)->pattern('text')->required()->max(40);
            $validation->name('description')->value($description)->pattern('text');
            $validation->name('client_id')->value($client_id)->pattern('int')->required();
            $validation->name('categorie_id')->value($categorie_id)->pattern('int')->required();
            
            // vérifier
            if($validation->isSuccess()){
                $projet = new ModelProjet();
                $insert = $projet->insert($_POST);
                
                requirePage::redirectPage('/projet/show/'.$insert);
            } else{
                // erreurs
                $errors = $validation->displayErrors();
            }
            
            // réafficher avec erreurs
            $client = new ModelClient();
            $selectClients = $client->select();
            
            $categorie = new ModelCategorie();
            $selectCategories = $categorie->select();
            
            twig::render('projet-create.php', ['errors' => $errors, 'projet' => $_POST, 'clients' => $selectClients, 'categories' => $selectCategories]);
        }

        /**
         * edit
         * Afficher les données d'un projet dans un formulaire pour les modifier.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent modifier un projet.
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
         * Valider les données reçues.
         * Mettre à jour les données d'un projet.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent modifier un projet.
         * @param { Int } $id - Clé primaire du projet à modifier
         */
        public function update(){
            CheckSession::sessionAuth();
            
            // client
            if($_SESSION['privilege_id'] == 3){
                RequirePage::redirectPage('/home/error');
            }
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('titre')->value($titre)->pattern('text')->required()->max(40);
            $validation->name('description')->value($description)->pattern('text');
            $validation->name('client_id')->value($client_id)->pattern('int')->required();
            $validation->name('categorie_id')->value($categorie_id)->pattern('int')->required();
            
            // vérifier
            if($validation->isSuccess()){
                $projet = new ModelProjet();
                $update = $projet->update($_POST);
                
                requirePage::redirectPage('/projet/show/'.$_POST['id']);
            } else{
                // erreurs
                $errors = $validation->displayErrors();
            }
            
            // réafficher avec erreurs
            $client = new ModelClient();
            $selectClients = $client->select();
            
            $categorie = new ModelCategorie();
            $selectCategories = $categorie->select();
            
            twig::render('projet-edit.php', ['errors' => $errors, 'projet' => $_POST, 'clients' => $selectClients, 'categories' => $selectCategories]);
        }

    }
?>
