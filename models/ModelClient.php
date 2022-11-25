<?php
    // class ModelClient
    class ModelClient extends CRUD{
        /**
         * propriétés
         * @protected {String} $table - Nom de la table db
         * @protected {String} $primaryKey - Nom de la clé primaire db
         * @protected {Array} $fillable - Tableau des colonnes de la db
         */
        protected $table = "client";
        protected $primaryKey = "client_id";
        protected $fillable = ["client_id", "nom", "adresse", "ville_id", "codePostal", "contact", "courriel", "phone"];

        /**
         * select
         * Récupérer toutes les données de la table reçue
         * @param {String} $col - Nom de la colonne par laquelle le tri s'effectue
         * @param {String} $ordre - Ordre ascendant ('ASC') ou descendant ('DESC')
         * @return {Array} - Toutes les données
         */
        public function selectClients($col='', $ordre='ASC'){
            // paramètres
            if($col == ""){
                $col = $this->primaryKey;
            }

            // requête
            $sql = "SELECT * FROM $this->table INNER JOIN `ville` ON ($this->table.`ville_id` = `ville`.`ville_id`) ORDER BY $col $ordre;";
            $stmt = $this->query($sql);

            // récupérer / renvoyer
            return $stmt->fetchAll();
        }

        /**
         * selectId
         * Récupérer les données par id de la table reçue
         * @param {Int} $id
         * @param {String} $url
         * @return {}
         */
        public function selectClientId($id, $url='/home/error/'){
            // requête
            $sql = "SELECT * FROM $this->table INNER JOIN ville ON ($this->table.ville_id = ville.ville_id) WHERE $this->primaryKey = :$this->primaryKey;";
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

