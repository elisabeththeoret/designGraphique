<?php
    // fichiers
    RequirePage::requireModel('CRUD');
    RequirePage::requireModel('ModelImage');
    RequirePage::requireModel('ModelProjet');

    // class ControllerImage
    class ControllerImage{

        /**
         * index
         * Afficher la première page qui liste les images.
         * Déclarer les variables qu'on veut accessible dans la page.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent voir la liste des images.
         */
        public function index(){
            CheckSession::sessionAuth();
            
            // admin ou employé.e
            if($_SESSION['privilege_id'] <= 2){
                $image = new ModelImage();
                $selectImages = $image->selectImages();
                
                twig::render("image-index.php", ['images' => $selectImages]);
            }
            // client
            else{
                RequirePage::redirectPage('/home/error');
            }
        }

        /**
         * show
         * Déclarer les variables qu'on veut accessible dans la page.
         * Afficher la page de détails d'une image.
         * @param { Int } $id - Clé primaire de l'image à afficher
         */
        public function show($id){
            $image = new ModelImage();
            $selectImage = $image->selectImageId($id);
            
            twig::render("image-show.php", ['image' => $selectImage]);
        }

        /**
         * create
         * Afficher la page pour ajouter une nouvelle image.
         * Déclarer les variables qu'on veut accessible dans la page.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent ajouter une nouvelle image.
         */
        public function create(){
            CheckSession::sessionAuth();
            
            // admin ou employé.e
            if($_SESSION['privilege_id'] <= 2){
                $projet = new ModelProjet();
                $selectProjets = $projet->selectProjets();
                
                if(! isset($_POST['id'])){
                    $_POST['projet_id'] = 0;
                } else{
                    $_POST['projet_id'] = $_POST['id'];
                }
                
                twig::render("image-create.php", ['image' => $_POST, 'projets' => $selectProjets]);
            }
            // client
            else{
                RequirePage::redirectPage('/home/error');
            }
        }

        /**
         * store
         * Valider les données reçues.
         * Enregistrer un nouveau projet.
         * Seul les utilisateurs 'Admin' et 'Employé.e' peuvent créer un nouveau projet.
         */
        public function store(){
            CheckSession::sessionAuth();
            
            // client
            if($_SESSION['privilege_id'] == 3){
                RequirePage::redirectPage('/home/error');
            }
            
            // valider
            $validation = new Validation();
            extract($_POST);
            $validation->name('projet_id')->value($projet_id)->pattern('int')->required();
            $validation->name('description')->value($description)->pattern('text');
            
            // vérifier
            if($validation->isSuccess()){
                $target_dir = "resources/img/";
                $target_file = $target_dir . basename($_FILES['fichier']['name']);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES['fichier']['tmp_name']);
                if($check !== false){
                    $uploadOk = 1;
                } else{
                    $errors = "Le fichier n'est pas une image.";
                    $uploadOk = 0;
                }
                
                // Check if file already exists
                if(file_exists($target_file)){
                    $errors = "Le fichier existe déjà.";
                    $uploadOk = 0;
                }
                
                // Check file size
                if($_FILES['fichier']['size'] > 1000000){
                    $errors = "Le fichier est trop lourd.";
                    $uploadOk = 0;
                }
                
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "svg"){
                    $errors = "Le fichier doir être un JPG, JPEG, PNG ou SVG.";
                    $uploadOk = 0;
                }
                
                // Check if $uploadOk is set to 0 by an error
                if($uploadOk != 0){
                    $_POST['fichier'] = basename($_FILES['fichier']['name']);
                    
                    if(move_uploaded_file($_FILES['fichier']['tmp_name'], $target_file)){
                        $image = new ModelImage();
                        $insertImage = $image->insert($_POST);
                        
                        RequirePage::redirectPage('/image/show/'.$insertImage);
                    }
                }
            }
            else{
                // erreurs
                $errors = $validation->displayErrors();
            }
            
            // réafficher avec erreurs
            $projet = new ModelProjet();
            $selectProjets = $projet->select();
            
            twig::render('image-create.php', ['errors' => $errors, 'image' => $_POST, 'projets' => $selectProjets]);
        }

        /**
         * delete
         * Supprimer une image.
         * Seul les utilisateurs 'Admin' peuvent supprimer une image.
         * @param { Int } $id - Clé primaire de l'image à supprimer
         */
        public function delete(){
            CheckSession::sessionAuth();
            
            // admin et employé.e
            if($_SESSION['privilege_id'] <= 2){
                $image = new ModelImage();
                $delete = $image->delete($_POST['id']);
                
                requirePage::redirectPage('/image');
            }
            // client
            else{
                RequirePage::redirectPage('/home/error');
            }
        }

    }
?>
