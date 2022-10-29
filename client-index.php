<?php
    // fichiers
    require_once('class/Crud.php');

    // données
    $Crud = new Crud();
    $client = $Crud->select('client', 'nom');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Accueil</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Retour -->
    <nav class="nav-principale">
        <a href="client-index.php">Accueil</a>
        <a href="client-create.php">Ajouter un client</a>
    </nav>

    <main>
        <h1>Liste de clients</h1>

        <!-- Liste -->
        <section class="flex-row section-cartes">
            <?php
                // données
                foreach($client as $row){
            ?>
            <article class="flex-col carte">
                <a href="client-show.php?id=<?= $row['id'] ?>"><?= $row['nom'] ?></a>
                <div class="flex-row">
                    <div>
                        <h2>Informations</h2>
                        <small>Adresse</small>
                        <p><?= $row['adresse'] ?></p>
                        <small>Code Postal</small>
                        <p><?= $row['codePostal'] ?></p>
                    </div>
                    <div>
                        <h2>Personne contact</h2>
                        <small>Contact</small>
                        <p><?= $row['contact'] ?></p>
                        <small>Courriel</small>
                        <p><?= $row['courriel'] ?></p>
                        <small>Phone</small>
                        <p><?= $row['phone'] ?></p>
                    </div>
                </div>
            </article>
            <?php
                }
            ?>
        </section>
    </main>
</body>
</html>

