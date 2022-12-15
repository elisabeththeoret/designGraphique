<?php
    // class ModelProjet
    class ModelProjet extends CRUD{
        /**
         * propriétés
         * @protected { String } $table - Nom de la table db
         * @protected { String } $primaryKey - Clé primaire de la table
         * 
         * @protected { Array } $fillable - Tableau des colonnes de la db
         * @protected { String } $render - Ce qui est retourné dans le tableau à afficher
         */
        protected $table = "projet";
        protected $primaryKey = "id";
        
        protected $fillable = ["id", "titre", "client_id", "categorie_id", "description"];
        protected $render = "projet.id, projet.titre, projet.description, client.id AS client_id, client.nom AS client_nom, categorie.nom AS categorie_nom";

        /**
         * select
         * Récupérer toutes les données de la table projet, incluant le client et la catégorie. 
         * @param { String } $col - Nom de la colonne par laquelle le tri s'effectue
         * @param { String } $ordre - Ordre ascendant ('ASC') ou descendant ('DESC')
         * @return { Array } - Toutes les données
         */
        public function selectProjets($col='id', $ordre='ASC', $url='/home/error'){
            // reqête
            $sql = "SELECT $this->render FROM $this->table INNER JOIN client ON ($this->table.client_id = client.id) INNER JOIN categorie ON ($this->table.categorie_id = categorie.id) ORDER BY $this->table.$col $ordre;";
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
         * Récupérer les données par id de la table projet, incluant le client et la catégorie. 
         * @param { Int } $id - Id du projet à afficher
         * @param { String } $url - Chemin où rediriger en cas d'erreur
         * @return { Array | redirect } 
         */
        public function selectProjetId($id, $url='/home/error'){
            // requête
            $sql = "SELECT $this->render FROM $this->table INNER JOIN client ON ($this->table.client_id = client.id) INNER JOIN categorie ON ($this->table.categorie_id = categorie.id) WHERE $this->table.$this->primaryKey = :$this->primaryKey;";
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
