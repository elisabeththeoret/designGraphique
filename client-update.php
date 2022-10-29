<?php
    // fichiers
    require_once('class/Crud.php');

    // données
    $Crud = new Crud();

    // requête
    $update = $Crud->update('client', $_POST);
?>

