{{ include('header.php', {title: 'Se connecter'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <h1>Se connecter</h1>
        
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
            
            <nav class="nav-action">
                <!-- Envoyer -->
                <input type="submit" class="bouton" value="Se connecter">
            </nav>
        </form>
    </main>
</body>
</html>
