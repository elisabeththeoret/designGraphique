{{ include('header.php', { title:'Nos projets' }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>Nos projets</h1>
            
            {% if session and session.privilege_id <= 2 %}
            <nav class="nav-action">
                <a class="bouton" href="{{ path }}/projet/create">Ajouter</a>
            </nav>
            {% endif %}
        </header>
        
        <!-- Liste -->
        <section class="grille">
            {% for projet in projets %}
            <article class="flex-col carte">
                <a href="{{ path }}/projet/show/{{ projet.id }}">{{ projet.titre }}</a>
                <div>
                    <small>{{ projet.client_nom }}</small>
                </div>
                <div>
                    <h2>{{ projet.categorie_nom }}</h2>
                    <p>{{ projet.description }}</p>
                </div>
            </article>
            {% endfor %}
        </section>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
