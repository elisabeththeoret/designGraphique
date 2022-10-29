<?php
    // fichiers
    require_once('class/Crud.php');

    if(isset($_GET['id'])){
        // données
        $id = $_GET['id'];
        $Crud = new Crud();

        // requête
        $client = $Crud->selectId('client', $id);

        // récupérer
        extract($client);

    } else{
        // rediriger
        header('Location: client-index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Show</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Retour -->
    <nav class="nav-principale">
        <a href="client-index.php">Accueil</a>
        <a href="client-create.php">Ajouter un client</a>
    </nav>

    <main>
        <!-- Afficher -->
        <h1><?= $nom ?></h1>
        <section class="flex-col">
            <article class="flex-row">
                <div>
                    <h2>Informations</h2>

                    <small>Adresse : </small>
                    <p><?= $adresse ?></p>

                    <small>Code postal : </small>
                    <p><?= $codePostal ?></p>
                </div>

                <div>
                    <h2>Personne contact</h2>

                    <small>Contact : </small>
                    <p><?= $contact ?></p>

                    <small>Courriel : </small>
                    <p><?= $courriel ?></p>

                    <small>Phone : </small>
                    <p><?= $phone ?></p>
                </div>
            </article>

            <nav class="nav-action">
                <!-- Retour -->
                <a class="bouton annuler" href="client-index.php">Retour</a>

                <!-- Modifier -->
                <a class="bouton" href="client-edit.php?id=<?= $id ?>">Modifier</a>
            </nav>
        </section>
    </main>
</body>
</html>

