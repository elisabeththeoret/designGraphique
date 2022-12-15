{{ include('header.php', {title: 'Accueil'}) }}
<body>
    <!-- Navigation Accueil -->
    <main class="accueil">
        <nav class="nav">
            <a href="{{ path }}/projet">Projets<span class="fleche">&#10095;</span></a>
            <a href="{{ path }}/service">Services<span class="fleche">&#10095;</span></a>
            <a href="{{ path }}/client">Clients<span class="fleche">&#10095;</span></a>
        </nav>
        <nav class="boutons">
            <a href="{{ path }}/user/login">Se connecter<span class="fleche">&#10095;</span></a>
            <a href="{{ path }}/user/create">S'inscrire<span class="fleche">&#10095;</span></a>
        </nav>
    </main>
</body>
</html>
