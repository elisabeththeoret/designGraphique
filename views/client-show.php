{{ include('header.php', { nom:client.nom }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <!-- Retour -->
    <nav class="fil-arianne">
        <a href="{{ path }}/client"><span class="fleche">&#10094;</span> Retour</a>
    </nav>
    
    <main>
        <header class="flex-row">
            <h1>{{ client.nom }}</h1>
            
            <nav class="nav-action">
                <!-- Modifier -->
                <a class="bouton" href="{{ path }}/client/edit/{{ client.id }}">Modifier</a>
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
    
    {{ include('footer.php') }}
</body>
</html>
