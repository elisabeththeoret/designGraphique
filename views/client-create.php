<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire | Design Graphique</title>
    <link rel="stylesheet" href="{{ path }}/resources/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-principale">
        <a href="{{ path }}/home">Accueil</a>
        <a href="{{ path }}/client">Clients</a>
        <aside class="boutons-action">
            <a href="{{ path }}/login">Se connecter</a>
            <a href="{{ path }}/client/create">S'inscrire</a>
        </aside>
    </nav>

    <main>
        <h1>S'inscrire</h1>

        <!-- Form Créer -->
        <form action="{{ path }}/client/store" method="post">
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Informations</h2></legend>

                    <label for="nom">Nom de l'entreprise*</label>
                    <input type="text" name="nom" id="nom">

                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse">

                    <label for="ville_id">Ville</label>
                    <select name="ville_id" id="ville_id">
                        {% for ville in villes %}
                        <option value="{{ ville.ville_id }}">{{ ville.ville_nom }}</option>
                        {% endfor %}
                    </select>

                    <label for="codePostal">Code postal</label>
                    <input type="text" name="codePostal" id="codePostal">
                </fieldset>

                <fieldset class="flex-col">
                    <legend><h2>Personne contact</h2></legend>

                    <label for="contact">Contact*</label>
                    <input type="text" name="contact" id="contact">

                    <label for="courriel">Courriel*</label>
                    <input type="email" name="courriel" id="courriel">

                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone">
                </fieldset>
            </div>

            <nav class="nav-action">
                <!-- Annuler -->
                <a class="bouton annuler" href="{{ path }}/client">Annuler</a>

                <!-- Envoyer -->
                <input type="submit" class="bouton" value="Envoyer">
            </nav>
        </form>
    </main>
</body>
</html>

