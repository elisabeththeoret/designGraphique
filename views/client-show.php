{{ include('header.php', {title: 'Client'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>{{ client.nom }}</h1>
            
            <nav class="nav-action">
                <!-- Modifier -->
                <a class="bouton" href="{{ path }}/client/edit/{{ client.id }}">Modifier</a>
                
                <!-- Supprimer -->
                <form action="{{ path }}/client/delete" method="post">
                    <input type="hidden" name="id" value="{{ client.id }}">
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
                    <p>{{ client.ville }}</p>
                    
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
