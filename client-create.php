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
        <h1>Ajouter un client</h1>

        <!-- Form Créer -->
        <form action="client-store.php" method="post">
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Informations</h2></legend>

                    <label for="nom">Nom de l'entreprise</label>
                    <input type="text" name="nom" id="nom">

                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse">

                    <label for="codePostal">Code postal</label>
                    <input type="text" name="codePostal" id="codePostal">
                </fieldset>

                <fieldset class="flex-col">
                    <legend><h2>Personne contact</h2></legend>

                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact">

                    <label for="courriel">Courriel</label>
                    <input type="email" name="courriel" id="courriel">

                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone">
                </fieldset>
            </div>

            <nav class="nav-action">
                <!-- Annuler -->
                <a class="bouton annuler" href="client-index.php">Annuler</a>

                <!-- Envoyer -->
                <input type="submit" class="bouton" value="Envoyer">
            </nav>
        </form>
    </main>
</body>
</html>

