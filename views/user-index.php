{{ include('header.php', {title: 'Utilisateurs'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <h1>Utilisateurs</h1>
        
        <!-- Liste -->
        <section class="grille">
            {% for user in users %}
            <article class="flex-col carte">
                <a href="{{ path }}/user/show/{{ user.id }}">{{ user.nom }}</a>
                <div>
                    <small>Username</small>
                    <p>{{ user.username }}</p>
                </div>
                <div>
                    <small>Privilège</small>
                    <p>{{ user.privilege_nom }}</p>
                </div>
            </article>
            {% endfor %}
        </section>
    </main>
</body>
</html>
