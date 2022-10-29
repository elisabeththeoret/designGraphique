<?php
    // fichiers
    require_once('class/Crud.php');

    // données
    $Crud = new Crud();

    // requête
    $insert = $Crud->insert('client', $_POST);

    // rediriger
    if($insert){
        header('Location: client-show.php?id='.$insert);
    } else{
        header('Location: client-index.php');
    }
?>

