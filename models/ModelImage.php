<?php
    // class ModelImage
    class ModelImage extends CRUD{

        /**
         * propriétés
         * @protected { String } $table - Nom de la table db
         * @protected { String } $primaryKey - Clé primaire de la table
         * 
         * @protected { Array } $fillable - Tableau des colonnes de la db
         * @protected { String } $render - Ce qui est retourné dans le tableau à afficher
         */
        protected $table = "image";
        protected $primaryKey = "id";
        
        protected $fillable = ["id", "fichier", "projet_id", "description"];
        protected $render = ["image.id", "image.fichier", "projet.id AS projet_id", "projet.titre AS projet_titre", "image.description", "categorie.id AS categorie_id", "categorie.nom AS categorie_nom"];

        /**
         * select
         * Récupérer toutes les données de la table image, incluant le projet et la catégorie. 
         * @param { String } $col - Nom de la colonne par laquelle le tri s'effectue
         * @param { String } $ordre - Ordre ascendant ('ASC') ou descendant ('DESC')
         * @param { String } $url - Chemin où rediriger en cas d'erreur
         * @return { Array } - Toutes les données
         */
        public function selectImages($col='id', $ordre='ASC', $url='/home/error'){
            // clés des données
            $data_keys = array_fill_keys($this->render, '');
            // données
            $nomChamps = implode(", ", array_keys($data_keys));
            
            // reqête
            $sql = "SELECT $nomChamps FROM $this->table INNER JOIN projet ON (image.projet_id = projet.id) INNER JOIN categorie ON (projet.categorie_id = categorie.id) ORDER BY $this->table.$col $ordre;";
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
         * Récupérer les données par id de la table image, incluant le projet et la catégorie. 
         * @param { Int } $id - Id de l'image à afficher
         * @param { String } $url - Chemin où rediriger en cas d'erreur
         * @return { Array | redirect } 
         */
        public function selectImageId($id, $url='/home/error'){
            // clés des données
            $data_keys = array_fill_keys($this->render, '');
            // données
            $nomChamps = implode(", ", array_keys($data_keys));
            
            // requête
            $sql = "SELECT $nomChamps FROM $this->table INNER JOIN projet ON (image.projet_id = projet.id) INNER JOIN categorie ON (projet.categorie_id = categorie.id) WHERE $this->table.$this->primaryKey = :$this->primaryKey;";
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
