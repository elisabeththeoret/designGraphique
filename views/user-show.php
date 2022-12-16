{{ include('header.php', {title: 'User'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>{{ user.nom }}</h1>

            <nav class="nav-action">
                <!-- Modifier -->
                <a href="{{ path }}/user/edit/{{ user.id }}" class="bouton">Modifier</a>
                
                {% if session.privilege_id == 1 %}
                <!-- Supprimer -->
                <form action="{{ path }}/user/delete" method="post">
                    <input type="hidden" name="id" value="{{ user.id }}">
                    <input class="bouton supprimer" type="submit" value="Supprimer">
                </form>
                {% endif %}
            </nav>
        </header>
        
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
        </section>
    </main>
</body>
</html>
