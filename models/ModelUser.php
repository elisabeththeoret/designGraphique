<?php
    // class ModelUser
    class ModelUser extends CRUD{
        /**
         * propriétés
         * @protected { String } $table - Nom de la table db
         * @protected { String } $primaryKey - Clé primaire de la table
         * 
         * @protected { Array } $fillable - Tableau des colonnes de la db
         */
        protected $table = "user";
        protected $primaryKey = "id";
        
        protected $fillable = ["id", "nom", "username", "password", "privilege_id"];
        protected $render = ["user.id", "user.nom", "user.username", "user.privilege_id", "privilege.nom AS privilege_nom"];

        /**
         * checkUser
         * Vérifier la connexion de l'utilisateur.
         * @param { Array } $data - Données de connexion 
         * @return { String } 
         */
        public function checkUser($data, $return=false){
            // récupérer les données
            extract($data);
            
            // requête
            $sql = "SELECT * FROM $this->table WHERE username = ?";
            $stmt = $this->prepare($sql);
            $stmt->execute(array($username));
            
            // vérifier le username
            $count = $stmt->rowCount();
            if($count == 1){
                // récupérer
                $user_info = $stmt->fetch();
                
                // vérifier le password
                if(password_verify($password, $user_info['password'])){
                    // session
                    session_regenerate_id();
                    $_SESSION['user_id'] = $user_info['id'];
                    $_SESSION['user_nom'] = $user_info['nom'];
                    $_SESSION['user_username'] = $user_info['username'];
                    $_SESSION['privilege_id'] = $user_info['privilege_id'];
                    $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                    
                    if(!$return){
                        requirePage::redirectPage('/user/page');
                    } else{
                        return 1;
                    }
                } else{
                    // erreur de password
                    return "Le mot de passe est incorrect";
                }
            } else{
                // erreur de username
                return "Le username est incorrect";
            }
        }

        /**
         * select (inner join ville)
         * Récupérer toutes les données de la table user, incluant le privilège.
         * @param { String } $col - Nom de la colonne par laquelle le tri s'effectue 
         * @param { String } $ordre - Ordre ascendant ('ASC') ou descendant ('DESC') 
         * @return { Array } - Toutes les données 
         */
        public function selectUsers($col='id', $ordre='ASC', $url='/home/error'){
            // clés des données
            $data_keys = array_fill_keys($this->render, '');
            // données
            $nomChamps = implode(", ", array_keys($data_keys));
            
            // requête
            $sql = "SELECT $nomChamps FROM $this->table INNER JOIN privilege ON (user.privilege_id = privilege.id) ORDER BY $this->table.$col $ordre;";
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
         * selectId (inner join ville)
         * Récupérer les données par id de la table user, incluant le privilège.
         * @param { Int } $id 
         * @param { String } $url - Redirection en cas d'erreur
         * @return { Array } - Données d'une rangée
         */
        public function selectUserId($id, $url='/home/error'){
            // clés des données
            $data_keys = array_fill_keys($this->render, '');
            // données
            $nomChamps = implode(", ", array_keys($data_keys));
            
            // requête
            $sql = "SELECT $nomChamps FROM $this->table INNER JOIN privilege ON (user.privilege_id = privilege.id) WHERE $this->table.$this->primaryKey = :$this->primaryKey;";
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
         * usernameExists
         * Vérifier si le username est déjà existant.
         * Si oui, comparer les identifiants pour savoir si le username est le même que l'utilisateur reçu. (update)
         * @param { String } $username 
         * @param { Int } $id - Id à comparer quand on update
         * @return { Bool } 
         */
        public function usernameExists($username, $id=null){
            // requête
            $sql = "SELECT $this->table.$this->primaryKey FROM $this->table WHERE $this->table.username = ?;";
            $stmt = $this->prepare($sql);
            $stmt->execute(array($username));
            
            // vérifier et retourner
            $count = $stmt->rowCount();
            if($count == 1){
                if($id == null){
                    return true;
                } else{
                    $user = $stmt->fetch();
                    
                    if($id == $user['id']){
                        return false;
                    } else{
                        return true;
                    }
                }
            } else{
                return false;
            }
        }

    }
?>
