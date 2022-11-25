<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos clients | Design Graphique</title>
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
        <h1>Nos clients</h1>

        <!-- Liste -->
        <section class="flex-row section-cartes">
            {% for client in clients %}
            <article class="flex-col carte">
                <a href="{{ path }}/client/show/{{ client.client_id }}">{{ client.nom }}</a>
                <div class="flex-row">
                    <div>
                        <h2>Informations</h2>
                        <small>Adresse</small>
                        <p>{{ client.adresse }}</p>
                        <small>Ville</small>
                        <p>{{ client.ville_nom }}</p>
                        <small>Code Postal</small>
                        <p>{{ client.codePostal }}</p>
                    </div>
                    <div>
                        <h2>Personne contact</h2>
                        <small>Contact</small>
                        <p>{{ client.contact }}</p>
                        <small>Courriel</small>
                        <p>{{ client.courriel }}</p>
                        <small>Phone</small>
                        <p>{{ client.phone }}</p>
                    </div>
                </div>
            </article>
            {% endfor %}
        </section>
    </main>
</body>
</html>

