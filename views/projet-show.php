{{ include('header.php', {title: 'Projet'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>{{ projet.titre }}</h1>
            
            <nav class="nav-action">
                <!-- Modifier -->
                <a class="bouton" href="{{ path }}/projet/edit/{{ projet.id }}">Modifier</a>
            </nav>
        </header>
        
        <!-- Afficher -->
        <section class="flex-col">
            <article class="flex-row">
                <div>
                    <h2>Informations</h2>
                    
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
</body>
</html>
