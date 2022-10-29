<?php
    // fichiers
    require_once('class/Crud.php');

    if(isset($_POST['id'])){
        // données
        $Crud = new Crud();

        // requête
        $delete = $Crud->delete('client', $_POST['id']);

    } else{
        // rediriger
        header('Location: client-index.php');
    }
?>

