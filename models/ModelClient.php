<?php
    // class ModelClient
    class ModelClient extends CRUD{
        /**
         * propriétés
         * @protected { String } $table - Nom de la table db
         * @protected { String } $primaryKey - Clé primaire de la table
         * 
         * @protected { Array } $fillable - Tableau des colonnes de la db
         * @protected { String } $render - Ce qui est retourné dans le tableau à afficher
         */
        protected $table = "client";
        protected $primaryKey = "id";
        
        protected $fillable = ["id", "nom", "adresse", "ville_id", "codePostal", "contact", "courriel", "phone"];
        protected $render = "client.id, client.nom, client.adresse, ville.nom AS ville, client.codePostal, client.contact, client.courriel, client.phone";

        /**
         * select
         * Récupérer toutes les données de la table client, incluant la ville.
         * @param { String } $col - Nom de la colonne par laquelle le tri s'effectue
         * @param { String } $ordre - Ordre ascendant ('ASC') ou descendant ('DESC')
         * @return { Array } - Toutes les données
         */
        public function selectClients($col='id', $ordre='ASC', $url='/home/error'){
            // requête
            $sql = "SELECT $this->render FROM $this->table INNER JOIN ville ON ($this->table.ville_id = ville.id) ORDER BY $col $ordre;";
            $stmt = $this->query($sql);
            
            if(!$stmt){
                // rediriger
                requirePage::redirectPage($url);
            } else{
                // récupérer / renvoyer
                return $stmt->fetchAll();
            }
        }

        /**
         * selectId
         * Récupérer les données par id de la table client, incluant la ville.
         * @param { Int } $id - Id du client à afficher
         * @param { String } $url - Chemin où rediriger en cas d'erreur
         * @return { Array | redirect }
         */
        public function selectClientId($id, $url='/home/error'){
            // requête
            $sql = "SELECT $this->render FROM $this->table INNER JOIN ville ON ($this->table.ville_id = ville.id) WHERE $this->table.$this->primaryKey = :$this->primaryKey;";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$this->primaryKey", $id);
            $stmt->execute();
            
            // vérifier
            $count = $stmt->rowCount();
            if($count == 1){
                // récupérer / renvoyer
                return $stmt->fetch();
            } else{
                // rediriger
                requirePage::redirectPage($url);
            }
        }

    }
?>
