<?php
    // Class Crud
    class Crud extends PDO{
        // constructor
        public function __construct(){
            parent::__construct("mysql:host=localhost; dbname=e2196008; port=3306; charset=utf8;", 'e2196008', 'GLJtizsoBlLZJLUh15Lh');
        }

        // Select
        public function select($table, $champ='id', $order='ASC'){
            // requête
            $sql = "SELECT * FROM $table ORDER BY $champ $order;";
            $stmt = $this->query($sql);

            // récupérer / renvoyer
            return $stmt->fetchAll();
        }

        // Select by id
        public function selectId($table, $valeur, $champId='id', $url='client-index.php'){
            // requête
            $sql = "SELECT * FROM $table WHERE $champId = :$champId;";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$champId", $valeur);
            $stmt->execute();

            // vérifier
            $count = $stmt->rowCount();
            if($count == 1){
                // récupérer / renvoyer
                return $stmt->fetch();
            } else{
                // rediriger
                header('Location: ' . $url);
            }
        }

        // Insert
        public function insert($table, $data){
            // données
            $nomChamp = implode(", ", array_keys($data));
            $valeurChamp = ":".implode(", :", array_keys($data));

            // requête
            $sql = "INSERT INTO $table ($nomChamp) VALUES ($valeurChamp);";
            $stmt = $this->prepare($sql);
            foreach($data as $key=>$value){
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

        // Update
        public function update($table, $data, $champId='id', $url='client-show.php?id='){
            // données
            $champRequete = null;
            foreach($data as $key=>$value){
                if($key != 'id'){
                    $champRequete .= "$key = :$key, ";
                }
            }
            $champRequete = rtrim($champRequete, ", ");

            // requête
            $sql = "UPDATE $table SET $champRequete WHERE $champId = :$champId;";
            $stmt = $this->prepare($sql);
            foreach($data as $key=>$value){
                $stmt->bindValue(":$key", $value);
            }

            // vérifier
            if(!$stmt->execute()){
                // erreur
                print_r($stmt->errorInfo());
            } else{
                // rediriger
                header('Location: ' . $url . $data['id']);
            }
        }

        // Delete
        public function delete($table, $valeur, $champId='id', $url='client-index.php'){
            // requête
            $sql = "DELETE FROM $table WHERE $champId = :$champId;";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$champId", $valeur);

            // vérifier
            if(!$stmt->execute()){
                // erreur
                print_r($stmt->errorInfo());
            } else{
                // rediriger
                header('Location: ' . $url);
            }
        }
    }
?>

