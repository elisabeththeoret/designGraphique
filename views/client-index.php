{{ include('header.php', {title: 'Nos clients'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <h1>Nos clients</h1>
        
        <!-- Liste -->
        <section class="grille">
            {% for client in clients %}
            <article class="flex-col carte">
                <a href="{{ path }}/client/show/{{ client.id }}">{{ client.nom }}</a>
                <div class="flex-row">
                    <div>
                        <h2>Informations</h2>
                        
                        <small>Adresse</small>
                        <p>{{ client.adresse }}</p>
                        
                        <small>Ville</small>
                        <p>{{ client.ville_nom }}</p>
                        
                        <small>Code Postal</small>
                        <p>{{ client.codePostal }}</p>
                    </div>
                    <div>
                        <h2>Personne contact</h2>
                        
                        <small>Contact</small>
                        <p>{{ client.contact }}</p>
                        
                        <small>Courriel</small>
                        <p>{{ client.courriel }}</p>
                        
                        <small>Phone</small>
                        <p>{{ client.phone }}</p>
                    </div>
                </div>
            </article>
            {% endfor %}
        </section>
    </main>
</body>
</html>
