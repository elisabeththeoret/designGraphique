{{ include('header.php', {title: 'Nouvel utilisateur'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <h1>Nouvel utilisateur</h1>
        
        <!-- Erreurs -->
        {% if errors %}
        <span class="errors">{{ errors | raw }}</span>
        {% endif %}
        
        <!-- Form Créer -->
        <form action="{{ path }}/user/store" method="post">
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Compte utilisateur</h2></legend>
                    
                    <label for="nom">Nom*</label>
                    <input type="text" name="nom" id="nom" value="{{ user.nom }}">
                    
                    <label for="username">Username*</label>
                    <input type="text" name="username" id="username" value="{{ user.username }}">
                    
                    <label for="password">Mot de passe*</label>
                    <input type="password" name="password" id="password">
                    
                    {% if session.privilege_id <= 2 %}
                    <label for="privilege">Privilege</label>
                    <select name="privilege_id" id="privilege">
                        {% for privilege in privileges %}
                        <option value="{{ privilege.id }}"
                            {% if session.privilege_id == 2 and privilege.id == 3 %}
                            selected
                            {% elseif session.privilege_id == 2 %}
                            disabled
                            {% endif %}>
                            {{ privilege.nom }}
                        </option>
                        {% endfor %}
                    </select>
                    {% endif %}
                </fieldset>
            </div>
            
            <nav class="nav-action">
                <!-- Envoyer -->
                <input type="submit" class="bouton" value="Envoyer">
            </nav>
        </form>
    </main>
</body>
</html>
