{{ include('header.php', { title: 'Accueil' }) }}

<body>
    <!-- Navigation Accueil -->
    <main class="accueil">
        <nav class="nav flex-col">
            <a href="{{ path }}/projet">Projets<span class="fleche">&#10095;</span></a>
            <a href="{{ path }}/service">Services<span class="fleche">&#10095;</span></a>
        </nav>
        
        <nav class="boutons flex-col">
            {% if guest %}
            <a href="{{ path }}/user/login">Se connecter<span class="fleche">&#10095;</span></a>
            {% else %}
            <a href="{{ path }}/user/page">{{ session.user_nom }}<span class="fleche">&#10095;</span></a>
            {% endif %}
            
            <aside class="grille">
                {% if session and session.privilege_id <= 2 %}
                <a href="{{ path }}/client" class="session">Clients<span class="fleche">&#10095;</span></a>
                <a href="{{ path }}/facture" class="session">Factures<span class="fleche">&#10095;</span></a>
                <a href="{{ path }}/user" class="session">Utilisateurs<span class="fleche">&#10095;</span></a>
                {% elseif session %}
                <a href="{{ path }}/projet" class="session">Mes projets<span class="fleche">&#10095;</span></a>
                <a href="{{ path }}/facture" class="session">Mes factures<span class="fleche">&#10095;</span></a>
                {% endif %}
            </aside>
        </nav>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
