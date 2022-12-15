{{ include('header.php', {title: 'Nos projets'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <h1>Nos projets</h1>
        
        <!-- Liste -->
        <section class="section-cartes">
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
</body>
</html>
