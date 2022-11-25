<?php
    // fichiers
    RequirePage::requireModel('CRUD');
    RequirePage::requireModel('ModelFacture');
    RequirePage::requireModel('ModelClient');
    RequirePage::requireModel('ModelProjet');
    RequirePage::requireModel('ModelService');

    // class ControllerClient
    class ControllerFacture{

        /**
         * index
         * Afficher la page principale qui liste les factures.
         * Déclarer les variables qu'on veut accessible dans la page.
         */
        public function index(){
            $facture = new ModelFacture();
            $selectFactures = $facture->select();

            twig::render("facture-index.php", ['factures' => $selectFactures]);
        }

        /**
         * show
         * Afficher les données d'une facture.
         * @param {Int} $id - Clé primaire de la facture à afficher
         */
        public function show($id){
            $facture = new ModelFacture();
            $selectFacture = $facture->selectId($id);

            twig::render("facture-show.php", ['facture' => $selectFacture]);
        }

        /**
         * create
         * Afficher la page pour créer une facture.
         */
        public function create(){
            $client = new ModelClient();
            $selectClients = $client->select();

            $projet = new ModelProjet();
            $selectProjets = $projet->select();

            $service = new ModelService();
            $selectServices = $service->select();

            twig::render('facture-create.php', ['clients' => $selectClients], ['projets' => $selectProjets], ['services' => $selectServices]);
        }

        /**
         * store
         * Enregistrer une nouvelle facture.
         */
        public function store(){
            $facture = new ModelFacture();
            $insert = $facture->insert($_POST);

            requirePage::redirectPage('facture/show/'.$insert);
        }

        /**
         * edit
         * Afficher les données d'une facture dans un formulaire pour les modifier.
         * @param {Int} $id - Clé primaire de la facture à afficher
         */
        public function edit($id){
            $facture = new ModelFacture();
            $selectFacture = $facture->selectId($id);

            twig::render('facture-edit.php', ['facture' => $selectFacture]);
        }

        /**
         * update
         * Mettre à jour les données d'une facture.
         * @param {Int} $id - Clé primaire de la facture à modifier
         */
        public function update(){
            $facture = new ModelFacture();
            $update = $facture->update($_POST);

            requirePage::redirectPage('facture/show/'.$_POST['id']);
        }

        /**
         * delete
         * Supprimer un facture.
         * @param {Int} $id - Clé primaire de la facture à supprimer
         */
        public function delete(){
            $facture = new ModelFacture();
            $delete = $facture->delete($_POST['id']);

            requirePage::redirectPage('facture');
        }
    }
?>

