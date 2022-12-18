{{ include('header.php', { title:'Galerie' }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>Galerie</h1>
            
            {% if session and session.privilege_id <= 2 %}
            <nav class="nav-action">
                <a class="bouton" href="{{ path }}/image/create">Ajouter</a>
            </nav>
            {% endif %}
        </header>
        
        <!-- Liste -->
        <section class="grille">
            {% for image in images %}
            <article class="flex-col carte">
                <a href="{{ path }}/image/show/{{ image.id }}">
                    <img src="{{ path }}/resources/img/{{ image.fichier }}" alt="{{ image.description }}">
                </a>
                <div>
                    <small>{{ image.projet_nom }}</small>
                </div>
                <div>
                    <h2>{{ image.categorie_nom }}</h2>
                    <p>{{ image.description }}</p>
                </div>
            </article>
            {% endfor %}
        </section>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
