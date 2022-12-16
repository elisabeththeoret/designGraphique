{{ include('header.php', {title: 'Modifier user'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <h1>Modifier {{ session.user_nom }}</h1>
        
        <!-- Erreurs -->
        {% if errors %}
        <span class="errors">{{ errors | raw }}</span>
        {% endif %}
        
        <!-- Form Modifier -->
        <form action="{{ path }}/user/update" method="post">
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Compte utilisateur</h2></legend>
                    
                    <input type="hidden" name="id" value="{{ user.id }}">
                    
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ user.nom }}">
                    
                    <label for="username_new">Username</label>
                    <input type="email" name="username_new" id="username_new" value="{{ user.username_new }}">
                    
                    {% if session.privilege_id <= 2 %}
                    <label for="privilege">Privilege</label>
                    <select name="privilege_id" id="privilege">
                        {% for privilege in privileges %}
                        <option value="{{ privilege.id }}"
                            {% if user.privilege_id == privilege.id %}
                            selected
                            {% elseif session.privilege_id == 2 %}
                            disabled
                            {% endif %}>
                            {{ privilege.nom }}
                        </option>
                        {% endfor %}
                    </select>
                    
                    {% else %}
                    <input type="hidden" name="privilege_id" value="3">
                    {% endif %}
                    
                    {% if session.user_id == user.id %}
                    <input type="hidden" name="username" id="username" value="{{ session.user_username }}">
                    
                    <label for="password">Confirmer les modifications</label>
                    <input type="password" name="password" id="password">
                    {% endif %}
                </fieldset>
            </div>
            
            <nav class="nav-action">
                <!-- Enregistrer -->
                <input type="submit" class="bouton" value="Enregistrer">
            </nav>
        </form>
    </main>
</body>
</html>
