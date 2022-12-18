{{ include('header.php', { nom:image.fichier }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <!-- Retour -->
    <nav class="fil-arianne">
        <a href="{{ path }}/image"><span class="fleche">&#10094;</span> Retour</a>
    </nav>
    
    <main>
        <header class="flex-row">
            <h1>Image</h1>
            
            {% if session and session.privilege_id <= 2 %}
            <nav class="nav-action">
                <!-- Modifier -->
                <a href="{{ path }}/image/edit/{{ image.id }}" class="bouton">Modifier</a>
                
                <!-- Supprimer -->
                <form action="{{ path }}/image/delete" method="post">
                    <input type="hidden" name="id" value="{{ image.id }}">
                    <input type="submit" value="Supprimer" class="bouton supprimer">
                </form>
            </nav>
            {% endif %}
        </header>
        
        <!-- Afficher -->
        <section class="flex-col">
            <article class="flex-row">
                <div>
                    <h2>Informations</h2>
                    
                    <small>Projet : </small>
                    <p>{{ image.projet_titre }}</p>
                    
                    <small>Catégorie : </small>
                    <p>{{ image.categorie_nom }}</p>
                    
                    <small>Description : </small>
                    <p>{{ image.description }}</p>
                </div>

                <div>
                    <img src="{{ path }}/resources/img/{{ image.fichier }}" alt="{{ image.description }}">
                </div>
            </article>
        </section>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
