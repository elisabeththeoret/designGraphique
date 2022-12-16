{{ include('header.php', {title: 'Nouveau user'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <h1>Nouveau user</h1>
        
        <!-- Erreurs -->
        {% if errors %}
        <span class="errors">{{ errors | raw }}</span>
        {% endif %}
        
        <!-- Form Créer -->
        <form action="{{ path }}/user/store" method="post">
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Comtpe utilisateur</h2></legend>
                    
                    <label for="nom">Nom*</label>
                    <input type="text" name="nom" id="nom" value="{{ user.nom }}">
                    
                    <label for="username">Username*</label>
                    <input type="text" name="username" id="username" value="{{ user.username }}">
                    
                    <label for="password">Mot de passe*</label>
                    <input type="password" name="password" id="password">
                    
                    {% if session.privilege_id == 1 or session.privilege_id == 2 %}
                    <label for="privilege">Privilege</label>
                    <select name="privilege_id" id="privilege">
                        {% if session.privilege_id == 1 %}
                        {% for privilege in privileges %}
                        <option value="{{ privilege.id }}" {% if user.privilege_id == privilege.id %} selected {% endif %}>{{ privilege.nom }}</option>
                        {% endfor %}
                        
                        {% elseif session.privilege_id == 2 %}
                        <option value="3" selected>{{ privileges[2].nom }}</option>
                        {% endif %}
                    </select>
                    
                    {% else %}
                    <input type="hidden" name="privilege_id" value="3">
                    {% endif %}
                </fieldset>
            </div>
            
            <nav class="nav-action">
                <!-- Envoyer -->
                <input type="submit" class="bouton" value="S'inscrire">
            </nav>
        </form>
    </main>
</body>
</html>
