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
            $client = new ModelClient();
            $selectClient = $client->selectClientId($id);
            
            twig::render("client-show.php", ['client' => $selectClient]);
        }

        /**
         * create
         * Afficher la page pour créer un client.
         */
        public function create(){
            $ville = new ModelVille();
            $selectVilles = $ville->select();
            
            twig::render('client-create.php', ['villes' => $selectVilles]);
        }

        /**
         * store
         * Enregistrer un nouveau client.
         */
        public function store(){
            $client = new ModelClient();
            $insert = $client->insert($_POST);
            
            requirePage::redirectPage('/client/show/'.$insert);
        }

        /**
         * edit
         * Afficher les données d'un client dans un formulaire pour les modifier.
         * @param { Int } $id - Clé primaire du client à afficher
         */
        public function edit($id){
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
            $client = new ModelClient();
            $update = $client->update($_POST);
            
            requirePage::redirectPage('/client/show/'.$_POST['id']);
        }

        /**
         * delete
         * Supprimer un client.
         * @param { Int } $id - Clé primaire du client à supprimer
         */
        public function delete(){
            $client = new ModelClient();
            $delete = $client->delete($_POST['id']);
            
            requirePage::redirectPage('/client');
        }

    }
?>
