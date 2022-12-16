<?php
    // fichiers
    RequirePage::requireModel('CRUD');
    RequirePage::requireModel('ModelUser');
    RequirePage::requireModel('ModelPrivilege');

    // class ControllerUser
    class ControllerUser{

        /**
         * index
         * Afficher la première page qui liste les clients.
         * Déclarer les variables qu'on veut accessible dans la page.
         */
        public function index(){
            CheckSession::sessionAuth();
            
            if($_SESSION['privilege_id'] == 1 || $_SESSION['privilege_id'] == 2){
                $user = new ModelUser();
                $selectUsers = $user->selectUsers('nom');
            
                twig::render("user-index.php", ['users' => $selectUsers]);
            } else{
                // rediriger
                RequirePage::redirectPage("/home/error");
            }
        }

        /**
         * show
         * Déclarer les variables qu'on veut accessible dans la page.
         * Afficher la page de la session du user avec twig.
         */
        public function page(){
            CheckSession::sessionAuth();
            
            $user = new ModelUser();
            $selectUser = $user->selectUserId($_SESSION['user_id']);
            
            twig::render('user-page.php', ['user' => $selectUser]);
        }

        /**
         * show
         * Déclarer les variables qu'on veut accessible dans la page.
         * Afficher la page d'accueil avec twig.
         */
        public function show($id){
            CheckSession::sessionAuth();
            
            $user = new ModelUser();
            $selectUser = $user->selectUserId($id);
            
            twig::render('user-show.php', ['user' => $selectUser]);
        }

        /**
         * create
         * Afficher la page pour créer un nouvel utilisateur avec twig.
         */
        public function create(){
            CheckSession::sessionAuth();
            
            // admin
            if($_SESSION['privilege_id'] == 1){
                $privilege = new ModelPrivilege();
                $selectPrivileges = $privilege->select();
                
                twig::render('user-create.php', ['privileges' => $selectPrivileges]);
            }
            // employé(e)
            else if($_SESSION['privilege_id'] == 2){
                $privilege = new ModelPrivilege();
                $selectPrivileges = $privilege->selectId("3");
                
                twig::render('user-create.php', ['privileges' => $selectPrivileges]);
            }
            // client et visiteur
            else{
                // rediriger
                RequirePage::redirectPage('/home/error');
            }
        }

        /**
         * store
         * Valider les données reçues.
         * Enregistrer un nouveau user.
         */
        public function store(){
            CheckSession::sessionAuth();
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('nom')->value($nom)->pattern('alpha')->required()->max(45);
            $validation->name('username')->value($username)->pattern('email')->required()->max(50);
            $validation->name('password')->value($password)->required()->max(20)->min(6);
            $validation->name('privilege_id')->value($privilege_id)->pattern('int')->required();
            
            // vérifier
            if($validation->isSuccess()){
                $options = [
                    'cost' => 10,
                ];
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
                
                $user = new ModelUser();
                $insertUser = $user->insert($_POST);
                $_POST = $user->selectId($insertUser);
                
                requirePage::redirectPage('/user/auth/'.$_POST);
            } else{
                $privilege = new ModelPrivilege();
                $selectPrivileges = $privilege->select();
                
                $errors = $validation->displayErrors();
                
                twig::render('user-create.php', ['errors' => $errors, 'user' => $_POST, 'privileges' => $selectPrivileges]);
            }
        }

        /**
         * login
         * Afficher la page pour que le user se connecte.
         */
        public function login(){
            twig::render('user-login.php');
        }

        /**
         * auth
         * Authentifier un user.
         */
        public function auth(){
            $user = new ModelUser();
            $checkUser = $user->checkUser($_POST);
            
            twig::render('user-login.php', ['errors' => $checkUser, 'data' => $_POST]);
        }

        /**
         * logout
         * Fermer la session et rediriger à la page pour se connecter.
         */
        public function logout(){
            session_destroy();
            
            RequirePage::redirectPage('/user/login');
        }

    }
?>

