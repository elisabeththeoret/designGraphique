<!-- Navigation -->
<nav class="nav-principale">
    <a href="{{ path }}/home">Accueil</a>
    <a href="{{ path }}/projet">Projets</a>
    <a href="{{ path }}/categorie">Services</a>
    
    {% if guest %}
    <aside class="action">
        <a href="{{ path }}/user/login" class="bouton-action">Se connecter</a>
    </aside>
    
    {% else %}
    <aside class="action">
        {% if session and session.privilege_id <= 2 %}
        <a href="{{ path }}/client">Clients</a>
        <a href="{{ path }}/facture">Factures</a>
        <a href="{{ path }}/user">Utilisateurs</a>
        {% elseif session %}
        <a href="{{ path }}/projet">Mes projets</a>
        <a href="{{ path }}/facture">Mes factures</a>
        {% endif %}
        
        <a href="{{ path }}/user/page" class="bouton-action">{{ session.user_nom }}</a>
    </aside>
    {% endif %}
</nav>
