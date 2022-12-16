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
         */
        public function index(){
            CheckSession::sessionAuth();
            
            $client = new ModelClient();
            $selectClients = $client->selectClients('nom');
            
            twig::render("client-index.php", ['clients' => $selectClients]);
        }

        /**
         * show
         * Afficher les données du client.
         * @param { Int } $id - Clé primaire du client à afficher
         */
        public function show($id){
            CheckSession::sessionAuth();
            
            $client = new ModelClient();
            $selectClient = $client->selectClientId($id);
            
            twig::render("client-show.php", ['client' => $selectClient]);
        }

        /**
         * create
         * Afficher la page pour créer un client.
         */
        public function create(){
            CheckSession::sessionAuth();
            
            $ville = new ModelVille();
            $selectVilles = $ville->select();
            
            twig::render('client-create.php', ['villes' => $selectVilles]);
        }

        /**
         * store
         * Enregistrer un nouveau client.
         */
        public function store(){
            CheckSession::sessionAuth();
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('nom')->value($nom)->pattern('alpha')->required()->max(40);
            $validation->name('adresse')->value($adresse)->max(50);
            $validation->name('codePostal')->value($codePostal)->max(10);
            $validation->name('contact')->value($contact)->pattern('alpha')->required()->max(30);
            $validation->name('courriel')->value($courriel)->pattern('email')->required()->max(50);
            $validation->name('phone')->value($phone)->max(20);
            
            // vérifier
            if($validation->isSuccess()){
                $client = new ModelClient();
                $insert = $client->insert($_POST);
                
                requirePage::redirectPage('/client/show/'.$insert);
            } else{
                $ville = new ModelVille();
                $selectVilles = $ville->select();
                
                $errors = $validation->displayErrors();
                
                twig::render('client-create.php', ['errors' => $errors, 'client' => $_POST, 'villes' => $selectVilles]);
            }
        }

        /**
         * edit
         * Afficher les données d'un client dans un formulaire pour les modifier.
         * @param { Int } $id - Clé primaire du client à afficher
         */
        public function edit($id){
            CheckSession::sessionAuth();
            
            $client = new ModelClient();
            $selectClient = $client->selectId($id);
            
            $ville = new ModelVille();
            $selectVilles = $ville->select();
            
            twig::render('client-edit.php', ['client' => $selectClient, 'villes' => $selectVilles]);
        }

        /**
         * update
         * Mettre à jour les données d'un client.
         * @param { Int } $id - Clé primaire du client à modifier
         */
        public function update(){
            CheckSession::sessionAuth();
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('nom')->value($nom)->required()->max(30);
            $validation->name('courriel')->value($courriel)->pattern('email')->required()->max(50);
            
            // vérifier
            if($validation->isSuccess()){
                $client = new ModelClient();
                $update = $client->update($_POST);
                
                requirePage::redirectPage('/client/show/'.$_POST['id']);
            } else{
                $ville = new ModelVille();
                $selectVilles = $ville->select();
                
                $errors = $validation->displayErrors();
                
                twig::render('client-edit.php', ['errors' => $errors, 'client' => $_POST, 'villes' => $selectVilles]);
            }
        }

        /**
         * delete
         * Supprimer un client.
         * @param { Int } $id - Clé primaire du client à supprimer
         */
        public function delete(){
            CheckSession::sessionAuth();
            
            $client = new ModelClient();
            $delete = $client->delete($_POST['id']);
            
            requirePage::redirectPage('/client');
        }

    }
?>
