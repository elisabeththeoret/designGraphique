<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ client.nom }} | Design Graphique</title>
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
        <header class="flex-row">
            <h1>{{ client.nom }}</h1>

            <nav class="nav-action">
                <!-- Modifier -->
                <a class="bouton" href="{{ path }}/client/edit/{{ client.client_id }}">Modifier</a>

                <!-- Supprimer -->
                <form action="{{ path }}/client/delete" method="post">
                    <input type="hidden" name="client_id" value="{{ client.client_id }}">
                    <input class="bouton supprimer" type="submit" value="Supprimer">
                </form>
            </nav>
        </header>

        <!-- Afficher -->
        <section class="flex-col">
            <article class="flex-row">
                <div>
                    <h2>Informations</h2>

                    <small>Adresse : </small>
                    <p>{{ client.adresse }}</p>

                    <small>Ville : </small>
                    <p>{{ client.ville_nom }}</p>

                    <small>Code postal : </small>
                    <p>{{ client.codePostal }}</p>
                </div>

                <div>
                    <h2>Personne contact</h2>

                    <small>Contact : </small>
                    <p>{{ client.contact }}</p>

                    <small>Courriel : </small>
                    <p>{{ client.courriel }}</p>

                    <small>Phone : </small>
                    <p>{{ client.phone }}</p>
                </div>
            </article>
        </section>
    </main>
</body>
</html>

