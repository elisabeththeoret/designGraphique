<?php
    // fichiers
    RequirePage::requireModel('CRUD');
    RequirePage::requireModel('ModelClient');
    RequirePage::requireModel('ModelVille');

    // class ControllerClient
    class ControllerClient{

        /**
         * index
         * Afficher la première page qui liste les clients.
         * Déclarer les variables qu'on veut accessible dans la page.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent voir la liste des clients.
         */
        public function index(){
            CheckSession::sessionAuth();
            
            // admin et employé.e
            if($_SESSION['privilege_id'] <= 2){
                $client = new ModelClient();
                $selectClients = $client->selectClients('nom');
                
                twig::render("client-index.php", ['clients' => $selectClients]);
            }
            // client
            else{
                RequirePage::redirectPage('/home/error');
            }
        }

        /**
         * show
         * Déclarer les variables qu'on veut accessible dans la page.
         * Afficher la page de détails d'un client.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent voir les détails d'un client.
         * @param { Int } $id - Clé primaire du client à afficher
         */
        public function show($id){
            CheckSession::sessionAuth();
            
            // admin ou employé.e
            if($_SESSION['privilege_id'] <= 2){
                $client = new ModelClient();
                $selectClient = $client->selectClientId($id);
                
                twig::render("client-show.php", ['client' => $selectClient]);
            }
            // client
            else{
                RequirePage::redirectPage("/home/error");
            }
        }

        /**
         * create
         * Afficher la page pour ajouter un nouveau client.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent ajouter un nouveau client.
         */
        public function create(){
            CheckSession::sessionAuth();
            
            // admin ou employé.e
            if($_SESSION['privilege_id'] <= 2){
                $ville = new ModelVille();
                $selectVilles = $ville->select();
                
                twig::render('client-create.php', ['villes' => $selectVilles]);
            }
            // client
            else{
                RequirePage::redirectPage("/home/error");
            }
        }

        /**
         * store
         * Valider les données reçues.
         * Enregistrer un nouveau client.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent ajouter un nouveau client.
         */
        public function store(){
            CheckSession::sessionAuth();
            
            // client
            if($_SESSION['privilege_id'] == 3){
                // rediriger
                RequirePage::redirectPage('/home/error');
            }
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('nom')->value($nom)->customPattern('[\p{L}\s-]+')->required()->max(40);
            $validation->name('adresse')->value($adresse)->max(50)->customPattern('[\p{L}0-9\s.,()-#]+');
            $validation->name('codePostal')->value($codePostal)->max(10)->pattern('alphanum');
            $validation->name('contact')->value($contact)->customPattern('[\p{L}\s-]+')->required()->max(30);
            $validation->name('courriel')->value($courriel)->pattern('email')->required()->max(50);
            $validation->name('phone')->value($phone)->max(20)->pattern('tel');
            $validation->name('ville_id')->value($ville_id)->pattern('int');
            
            // vérifier
            if($validation->isSuccess()){
                $client = new ModelClient();
                $insert = $client->insert($_POST);
                
                requirePage::redirectPage('/client/show/'.$insert);
            }
            // réafficher avec erreurs
            else{
                $ville = new ModelVille();
                $selectVilles = $ville->select();
                
                $errors = $validation->displayErrors();
                
                twig::render('client-create.php', ['errors' => $errors, 'client' => $_POST, 'villes' => $selectVilles]);
            }
        }

        /**
         * edit
         * Afficher les données d'un client dans un formulaire pour les modifier.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent modifier un nouveau client.
         * @param { Int } $id - Clé primaire du client à afficher
         */
        public function edit($id){
            CheckSession::sessionAuth();
            
            // admin et employé.e
            if($_SESSION['privilege_id'] <= 2){
                $client = new ModelClient();
                $selectClient = $client->selectId($id);
                
                $ville = new ModelVille();
                $selectVilles = $ville->select();
                
                twig::render('client-edit.php', ['client' => $selectClient, 'villes' => $selectVilles]);
            }
            // client
            else{
                RequirePage::redirectPage('/home/error');
            }
        }

        /**
         * update
         * Valider les données reçues.
         * Mettre à jour les données d'un client.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent modifier un nouveau client.
         * @param { Int } $id - Clé primaire du client à modifier
         */
        public function update(){
            CheckSession::sessionAuth();
            
            // client
            if($_SESSION['privilege_id'] == 3){
                // rediriger
                RequirePage::redirectPage('/home/error');
            }
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('nom')->value($nom)->customPattern('[\p{L}\s-]+')->required()->max(40);
            $validation->name('adresse')->value($adresse)->max(50)->customPattern('[\p{L}0-9\s.,()-]+');
            $validation->name('codePostal')->value($codePostal)->max(10)->pattern('alphanum');
            $validation->name('contact')->value($contact)->customPattern('[\p{L}\s-]+')->required()->max(30);
            $validation->name('courriel')->value($courriel)->pattern('email')->required()->max(50);
            $validation->name('phone')->value($phone)->max(20)->pattern('tel');
            $validation->name('ville_id')->value($ville_id)->pattern('int');
            
            // vérifier
            if($validation->isSuccess()){
                $client = new ModelClient();
                $update = $client->update($_POST);
                
                requirePage::redirectPage('/client/show/'.$_POST['id']);
            }
            // réafficher avec erreurs
            else{
                $ville = new ModelVille();
                $selectVilles = $ville->select();
                
                $errors = $validation->displayErrors();
                
                twig::render('client-edit.php', ['errors' => $errors, 'client' => $_POST, 'villes' => $selectVilles]);
            }
        }

    }
?>
