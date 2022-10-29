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
    <title>Client Create</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Retour -->
    <nav class="nav-principale">
        <a href="client-index.php">Accueil</a>
        <a href="client-create.php">Ajouter un client</a>
    </nav>

    <main>
        <h1>Modifier le client</h1>

        <!-- Form Modifier -->
        <form action="client-update.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Informations</h2></legend>

                    <label for="nom">Nom de l'entreprise</label>
                    <input type="text" name="nom" id="nom" value="<?= $nom ?>">

                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse" value="<?= $adresse ?>">

                    <label for="codePostal">Code postal</label>
                    <input type="text" name="codePostal" id="codePostal" value="<?= $codePostal ?>">
                </fieldset>

                <fieldset class="flex-col">
                    <legend><h2>Personne contact</h2></legend>

                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" value="<?= $contact ?>">

                    <label for="courriel">Courriel</label>
                    <input type="email" name="courriel" id="courriel" value="<?= $courriel ?>">

                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?= $phone ?>">
                </fieldset>
            </div>

            <nav class="nav-action">
                <!-- Annuler -->
                <a class="bouton annuler" href="client-show.php?id=<?= $id ?>">Annuler</a>

                <!-- Form Supprimer -->
                <form action="client-delete.php" method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="submit" class="bouton supprimer" value="Supprimer">
                </form>

                <!-- Enregistrer -->
                <input type="submit" class="bouton" value="Enregistrer">
            </nav>
        </form>
    </main>
</body>
</html>

