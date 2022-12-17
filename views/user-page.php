{{ include('header.php', { nom:session.user_nom }) }}

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
                    <nav class="nav-liens">
                        <a href="{{ path }}/projet" class="lien-fleche">
                            <span>Voir la liste des projets</span>
                            <span class="fleche">&#10095;</span>
                        </a>
                        <a href="{{ path }}/projet/create" class="lien-fleche">Créer un nouveau projet <span class="fleche">&#10095;</span></a>
                    </nav>
                </article>
                
                <article>
                    <h2>Clients</h2>
                    <nav class="nav-liens">
                        <a href="{{ path }}/client" class="lien-fleche">Voir la liste des clients <span class="fleche">&#10095;</span></a>
                        <a href="{{ path }}/client/create" class="lien-fleche">Ajouter un client <span class="fleche">&#10095;</span></a>
                    </nav>
                </article>
                
                <article>
                    <h2>Factures</h2>
                    <nav class="nav-liens">
                        <a href="{{ path }}/facture" class="lien-fleche">Voir la liste des factures <span class="fleche">&#10095;</span></a>
                        <a href="{{ path }}/factures/create" class="lien-fleche">Ajouter un nouvelle facture <span class="fleche">&#10095;</span></a>
                    </nav>
                </article>
                
                <article>
                    <h2>Utilisateurs</h2>
                    <nav class="nav-liens">
                        <a href="{{ path }}/user" class="lien-fleche">Voir la liste des utilisateurs <span class="fleche">&#10095;</span></a>
                        <a href="{{ path }}/user/create" class="lien-fleche">Ajouter un nouveau utilisateur <span class="fleche">&#10095;</span></a>
                    </nav>
                </article>
            </section>
            
            {% else %}
            <section class="flex-col">
                <article>
                    <h2>Consulter</h2>
                    <nav class="nav-liens">
                        <a href="{{ path }}/projet/show/1" class="lien-fleche">Voir la liste de mes projets <span class="fleche">&#10095;</span></a>
                        <a href="{{ path }}/facture/show/1" class="lien-fleche">Voir la liste de mes factures <span class="fleche">&#10095;</span></a>
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
                        <input type="submit" value="Supprimer" class="bouton supprimer">
                    </form>
                </nav>
            </section>
        </div>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
