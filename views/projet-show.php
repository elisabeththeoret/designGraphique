{{ include('header.php', { nom:projet.titre }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <!-- Retour -->
    <nav class="fil-arianne">
        <a href="{{ path }}/projet"><span class="fleche">&#10094;</span> Retour</a>
    </nav>
    
    <main>
        <header class="flex-row">
            <h1>{{ projet.titre }}</h1>
            
            {% if session and session.privilege_id <= 2 %}
            <nav class="nav-action">
                <!-- Modifier -->
                <a class="bouton" href="{{ path }}/projet/edit/{{ projet.id }}">Modifier</a>
            </nav>
            {% endif %}
        </header>
        
        
        <!-- Afficher -->
        <section class="flex-col">
            <article>
                <h2>Informations</h2>
                <div>
                    <small>Client : </small>
                    <p>{{ projet.client_nom }}</p>
                    
                    <small>Catégorie : </small>
                    <p>{{ projet.categorie_nom }}</p>
                    
                    <small>Description : </small>
                    <p>{{ projet.description }}</p>
                </div>
            </article>
        </section>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
