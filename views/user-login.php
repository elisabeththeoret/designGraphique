{{ include('header.php', { title:'Se connecter' }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>Se connecter</h1>
        </header>
        
        <!-- Erreurs -->
        {% if errors %}
        <span class="errors">{{ errors | raw }}</span>
        {% endif %}
        
        <!-- Form Créer -->
        <form action="{{ path }}/user/auth" method="post">
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Compte utilisateur</h2></legend>
                    
                    <label for="username">Username*</label>
                    <input type="text" name="username" id="username" value="{{ user.username }}">
                    
                    <label for="ville_id">Mot de passe*</label>
                    <input type="password" name="password" id="password">
                </fieldset>
            </div>
            
            <div class="flex-row">
                <nav class="nav-action">
                    <!-- Envoyer -->
                    <input type="submit" class="bouton" value="Se connecter">
                </nav>
                
                {% if errors %}
                <!-- Aide -->
                <div class="flex-row aide">
                    <small>Un problème?  Besoin d'aide?</small>
                    <a href="#" class="bouton annuler">Contactez-nous</a>
                </div>
                {% endif %}
            </div>
        </form>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
