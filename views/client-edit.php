<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier {{ client.nom }} | Design Graphique</title>
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
        <h1>Modifier le client</h1>

        <!-- Form Modifier -->
        <form action="{{ path }}/client/update" method="post">
            <input type="hidden" name="client_id" value="{{ client.client_id }}">

            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Informations</h2></legend>

                    <label for="nom">Nom de l'entreprise</label>
                    <input type="text" name="nom" id="nom" value="{{ client.nom }}">

                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse" value="{{ client.adresse }}">

                    <label for="ville_id">Ville</label>
                    <select name="ville_id" id="ville_id">
                        {% for ville in villes %}
                        <option value="{{ ville.ville_id }}" {% if ville.ville_id == client.ville_id %}selected{% endif %}>{{ ville.ville_nom }}</option>
                        {% endfor %}
                    </select>

                    <label for="codePostal">Code postal</label>
                    <input type="text" name="codePostal" id="codePostal" value="{{ client.codePostal }}">
                </fieldset>

                <fieldset class="flex-col">
                    <legend><h2>Personne contact</h2></legend>

                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" value="{{ client.contact }}">

                    <label for="courriel">Courriel</label>
                    <input type="email" name="courriel" id="courriel" value="{{ client.courriel }}">

                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ client.phone }}">
                </fieldset>
            </div>

            <nav class="nav-action">
                <!-- Annuler -->
                <a class="bouton annuler" href="{{ path }}/client/show/{{ client.client_id }}">Annuler</a>

                <!-- Enregistrer -->
                <input type="submit" class="bouton" value="Enregistrer">
            </nav>
        </form>
    </main>
</body>
</html>

