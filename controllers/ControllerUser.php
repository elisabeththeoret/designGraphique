<?php
    // fichiers
    RequirePage::requireModel('CRUD');
    RequirePage::requireModel('ModelUser');
    RequirePage::requireModel('ModelPrivilege');

    // class ControllerUser
    class ControllerUser{

        /**
         * login
         * Afficher la page pour qu'un utilisateur se connecte.
         */
        public function login(){
            twig::render('user-login.php');
        }

        /**
         * auth
         * Authentifier un utilisateur.
         */
        public function auth(){
            $user = new ModelUser();
            $checkUser = $user->checkUser($_POST);
            
            twig::render('user-login.php', ['errors' => $checkUser, 'user' => $_POST]);
        }

        /**
         * logout
         * Fermer la session et rediriger à la page pour se connecter.
         */
        public function logout(){
            session_destroy();
            
            RequirePage::redirectPage('/user/login');
        }

        /**
         * show
         * Déclarer les variables qu'on veut accessible dans la page.
         * Afficher la page de la session de l'utilisateur.
         */
        public function page(){
            CheckSession::sessionAuth();
            
            $user = new ModelUser();
            $selectUser = $user->selectUserId($_SESSION['user_id']);
            
            twig::render('user-page.php', ['user' => $selectUser]);
        }

        /**
         * index
         * Afficher la première page qui liste les utilisateurs.
         * Déclarer les variables qu'on veut accessible dans la page.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent voir la liste des utilisateurs.
         */
        public function index(){
            CheckSession::sessionAuth();
            
            // admin ou employé.e
            if($_SESSION['privilege_id'] <= 2){
                $user = new ModelUser();
                $selectUsers = $user->selectUsers('nom');
            
                twig::render("user-index.php", ['users' => $selectUsers]);
            }
            // client
            else{
                // rediriger
                RequirePage::redirectPage("/home/error");
            }
        }

        /**
         * show
         * Déclarer les variables qu'on veut accessible dans la page.
         * Afficher la page de détails d'un utilisateur.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent voir les détails d'un utilisateur.
         */
        public function show($id){
            CheckSession::sessionAuth();
            
            // admin ou employé.e
            if($_SESSION['privilege_id'] <= 2){
                $user = new ModelUser();
                $selectUser = $user->selectUserId($id);
                
                twig::render('user-show.php', ['user' => $selectUser]);
            }
            // client
            else{
                // rediriger
                RequirePage::redirectPage("/home/error");
            }
        }

        /**
         * create
         * Afficher la page pour créer un nouvel utilisateur.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent créer un nouvel utilisateur.
         */
        public function create(){
            CheckSession::sessionAuth();
            
            // admin ou employé.e
            if($_SESSION['privilege_id'] <= 2){
                $privilege = new ModelPrivilege();
                $selectPrivileges = $privilege->select();
                
                twig::render('user-create.php', ['privileges' => $selectPrivileges]);
            }
            // client
            else{
                // rediriger
                RequirePage::redirectPage('/home/error');
            }
        }

        /**
         * store
         * Valider les données reçues.
         * Enregistrer un nouvel utilisateur.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent créer un nouvel utilisateur.
         */
        public function store(){
            CheckSession::sessionAuth();
            
            // client
            if($_SESSION['privilege_id'] == 3){
                // rediriger
                RequirePage::redirectPage('/home/error');
            }
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('nom')->value($nom)->customPattern('[\p{L}\s-]+')->required()->max(45);
            $validation->name('username')->value($username)->pattern('email')->required()->max(50);
            $validation->name('password')->value($password)->required()->max(20)->min(6);
            $validation->name('privilege_id')->value($privilege_id)->pattern('int')->required();
            
            // vérifier
            if($validation->isSuccess()){
                $user = new ModelUser();
                
                // vérifier username
                if(! $user->usernameExists($username)){
                    $options = [
                        'cost' => 10,
                    ];
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
                    
                    $insertUser = $user->insert($_POST);
                    
                    requirePage::redirectPage('/user');
                } else{
                    // erreurs
                    $errors = "Le username est déjà existant. Veuillez en entrer un nouveau.";
                }
            } else{
                // erreurs
                $errors = $validation->displayErrors();
            }
            
            // réafficher la page create pour corriger les erreurs
            $privilege = new ModelPrivilege();
            $selectPrivileges = $privilege->select();
            
            twig::render('user-create.php', ['errors' => $errors, 'user' => $_POST, 'privileges' => $selectPrivileges]);
        }

        /**
         * edit
         * Afficher les données d'un utilisateur dans un formulaire pour les modifier.
         * @param { Int } $id - Clé primaire de l'utilisateur à afficher
         */
        public function edit($id){
            CheckSession::sessionAuth();
            
            // client - si ce n'est pas son propre identifiant
            if($_SESSION['privilege_id'] == 3 && $_SESSION['user_id'] != $id ){
                $id = $_SESSION['user_id'];
            }
            
            $user = new ModelUser();
            $selectUser = $user->selectUserId($id);
            $selectUser['username_new'] = $selectUser['username'];
            
            $privilege = new ModelPrivilege();
            $selectPrivileges = $privilege->select();
            
            twig::render('user-edit.php', ['user' => $selectUser, 'privileges' => $selectPrivileges]);
        }

        /**
         * update
         * Valider les données reçues.
         * Mettre à jour les données d'un utilisateur.
         * @param { Int } $id - Clé primaire de l'utilisateur à modifier
         */
        public function update(){
            CheckSession::sessionAuth();
            
            // client - si ce n'est pas son propre identifiant
            if($_SESSION['privilege_id'] == 3 && $_SESSION['user_id'] != $_POST['id']){
                $_POST['id'] = $_SESSION['user_id'];
            }
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('nom')->value($nom)->customPattern('[\p{L}\s-]+')->required()->max(45);
            $validation->name('username_new')->value($username_new)->pattern('email')->required()->max(50);
            $validation->name('privilege_id')->value($privilege_id)->pattern('int')->required();
            if(isset($_POST['password'])){
                $validation->name('password')->value($password)->required()->max(20)->min(6);
            }
            
            // vérifier
            if($validation->isSuccess()){
                $user = new ModelUser();
                
                // vérifier username
                if(! $user->usernameExists($username_new, $id)){
                    // session active
                    if($_SESSION['user_id'] == $_POST['id']){
                        $checkUser = $user->checkUser($_POST, true);
                        
                        if($checkUser == 1){
                            unset($_POST['password']);
                            $_POST['username'] = $username_new;
                            unset($_POST['username_new']);
                            $update = $user->update($_POST);
                            
                            // récupérer les nouvelles données de session
                            $_POST['password'] = $password;
                            
                            $auth = $this->auth($_POST);
                        }
                        else{
                            // erreurs
                            $errors = "Le mot de passe n'est pas valide.";
                        }
                    }
                    // admin et employé.e
                    else{
                        requirePage::redirectPage('/user/show/'.$_POST['id']);
                    }
                }
                else{
                    // erreurs
                    $errors = "Le username est déjà existant. Veuillez en entrer un nouveau.";
                }
            }
            else{
                // erreurs
                $errors = $validation->displayErrors();
            }
            
            // réafficher la page create pour corriger les erreurs
            $privilege = new ModelPrivilege();
            $selectPrivileges = $privilege->select();
            
            twig::render('user-edit.php', ['errors' => $errors, 'user' => $_POST, 'privileges' => $selectPrivileges]);
        }

        /**
         * delete
         * Supprimer un utilisateur.
         * Seul les utilisateurs 'Admin' peuvent supprimer un utilisateur.
         * @param { Int } $id - Clé primaire de l'utilisateur à supprimer
         */
        public function delete(){
            CheckSession::sessionAuth();
            
            // admin
            if($_SESSION['privilege_id'] == 1){
                $user = new ModelUser();
                $delete = $user->delete($_POST['id']);
                
                requirePage::redirectPage('/user');
            }
            // employé.e et client
            else{
                RequirePage::redirectPage('/home/error');
            }
        }

    }
?>

