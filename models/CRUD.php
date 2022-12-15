<?php
    // class CRUD
    abstract class CRUD extends PDO{

        /**
         * construct
         * Construire la connexion avec la base de données
         */
        public function __construct(){
            parent::__construct("mysql:host=localhost; dbname=designGraphique; port=3306; charset=utf8;", 'root', 'root');
        }

        /**
         * select
         * Récupérer toutes les données de la table reçue
         * @param { String } $col - Nom de la colonne par laquelle le tri s'effectue
         * @param { String } $ordre - Ordre ascendant ('ASC') ou descendant ('DESC')
         * @return { Array } - Toutes les données
         */
        public function select($col='', $ordre='ASC', $url='/home/error'){
            // paramètres
            if($col == ""){
                $col = $this->primaryKey;
            }
            
            // requête
            $sql = "SELECT * FROM $this->table ORDER BY $col $ordre;";
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
         * Récupérer les données par id de la table reçue
         * @param {Int} $id
         * @param {String} $url
         * @return {}
         */
        public function selectId($id, $url='/home/error'){
            // requête
            $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey;";
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

        /**
         * insert
         * @param { Array } $data
         */
        public function insert($data){
            // clés des données
            $data_keys = array_fill_keys($this->fillable, '');
            $data_map = array_intersect_key($data, $data_keys);
            
            // données
            $nomChamp = implode(", ", array_keys($data_map));
            $valeurChamp = ":".implode(", :", array_keys($data_map));
            
            // requête
            $sql = "INSERT INTO $this->table ($nomChamp) VALUES ($valeurChamp);";
            $stmt = $this->prepare($sql);
            foreach($data_map as $key=>$value){
                $stmt->bindValue(":$key", $value);
            }
            
            // vérifier
            if(!$stmt->execute()){
                // erreur
                print_r($stmt->errorInfo());
            } else{
                // récupérer / renvoyer
                return $this->lastInsertId();
            }
        }

        /**
         * update
         * @param { Array } $data
         */
        public function update($data){
            // nettoyer
            $champRequete = null;
            foreach($data as $key=>$value){
                $champRequete .= "$key = :$key, ";
            }
            $champRequete = rtrim($champRequete, ", ");
            
            // requête
            $sql = "UPDATE $this->table SET $champRequete WHERE $this->primaryKey = :$this->primaryKey";
            $stmt = $this->prepare($sql);
            foreach($data as $key=>$value){
                $stmt->bindValue(":$key", $value);
            }
            
            // vérifier
            if(!$stmt->execute()){
                print_r($stmt->errorInfo());
            } else{
                return true;
            }
        }

        /**
         * delete
         * @param { Int } $id
         */
        public function delete($id){
            // requête
            $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey;";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$this->primaryKey", $id);
            
            // vérifier
            if(!$stmt->execute()){
                print_r($stmt->errorInfo());
            } else{
                return true;
            }
        }

    }
?>
