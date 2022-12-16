{{ include('header.php', {title: 'Bonjour'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>Bonjour {{ session.user_nom }}!</h1>
            
            <nav class="nav-action">
                <!-- Déconnexion -->
                <a class="bouton" href="{{ path }}/user/logout">Déconnexion</a>
            </nav>
        </header>
        
        <div class="flex-row">
            {% if user.privilege_id == 1 or user.privilege_id == 2 %}
            <section class="flex-col">
                <article>
                    <h2>Projets</h2>
                    <nav class="flex-col">
                        <a href="{{ path }}/projet">Voir la liste des projets <span class="fleche">&#10095;</span></a>
                        <a href="{{ path }}/projet/create">Créer un nouveau projet <span class="fleche">&#10095;</span></a>
                    </nav>
                </article>
                
                <article>
                    <h2>Clients</h2>
                    <nav class="flex-col">
                        <a href="{{ path }}/client">Voir la liste des clients <span class="fleche">&#10095;</span></a>
                        <a href="{{ path }}/client/create">Ajouter un client <span class="fleche">&#10095;</span></a>
                    </nav>
                </article>
                
                <article>
                    <h2>Factures</h2>
                    <nav class="flex-col">
                        <a href="{{ path }}/facture">Voir la liste des factures <span class="fleche">&#10095;</span></a>
                        <a href="{{ path }}/factures/create">Ajouter un nouvelle facture <span class="fleche">&#10095;</span></a>
                    </nav>
                </article>
                
                <article>
                    <h2>Utilisateurs</h2>
                    <nav class="flex-col">
                        <a href="{{ path }}/user">Voir la liste des utilisateurs <span class="fleche">&#10095;</span></a>
                        <a href="{{ path }}/user/create">Ajouter un nouveau utilisateur <span class="fleche">&#10095;</span></a>
                    </nav>
                </article>
            </section>
            {% else %}
            <section class="flex-col">
                <article>
                    <h2>Consulter</h2>
                    <nav class="flex-col">
                        <a href="{{ path }}/projet/show/1">Voir la liste de mes projets <span class="fleche">&#10095;</span></a>
                        <a href="{{ path }}/facture/show/1">Voir la liste de mes factures <span class="fleche">&#10095;</span></a>
                    </nav>
                </article>
            </section>
            {% endif %}
            
            <section class="flex-col">
                <article>
                    <h2>Informations</h2>
                    
                    <div>
                        <small>Username</small>
                        <p>{{ user.username }}</p>
                    
                        <small>Compte</small>
                        <p>{{ user.privilege_nom }}</p>
                    </div>
                </article>
                
                <nav class="nav-action">
                    <!-- Modifier -->
                    <a href="{{ path }}/user/edit/{{ session.user_id }}" class="bouton">Modifier</a>
                
                    <!-- Supprimer -->
                    <form action="{{ path }}/user/delete" method="post">
                        <input type="hidden" name="id" value="{{ session.user_id }}">
                        <input class="bouton supprimer" type="submit" value="Supprimer">
                    </form>
                </nav>
            </section>
        </div>
    </main>
</body>
</html>
