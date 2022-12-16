<!-- Navigation -->
<nav class="nav-principale">
    <a href="{{ path }}/home">Accueil</a>
    <a href="{{ path }}/projet">Projets</a>
    <a href="{{ path }}/categorie">Services</a>
    
    {% if guest %}
    <aside class="boutons-action">
        <a href="{{ path }}/user/login">Se connecter</a>
    </aside>
    
    {% else %}
        {% if session.privilege_id <= 2 %}
        <a href="{{ path }}/client">Clients</a>
        <a href="{{ path }}/facture">Factures</a>
        <a href="{{ path }}/user">Utilisateurs</a>
        {% endif %}
        
        <aside class="boutons-action">
            <a href="{{ path }}/user/page">{{ session.user_nom }}</a>
        </aside>
    {% endif %}
</nav>
