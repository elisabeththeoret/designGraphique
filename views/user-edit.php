{{ include('header.php', { title:'Modifier', nom:user.nom }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>Modifier {{ user.nom }}</h1>
        </header>
        
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
                    
                    {% if session.privilege_id <= 2 and session.user_id != user.id %}
                    <label for="privilege">Privilege</label>
                    <select name="privilege_id" id="privilege">
                        {% for privilege in privileges %}
                        <option value="{{ privilege.id }}"
                            {% if user.privilege_id == privilege.id %} selected
                            {% elseif session.privilege_id == 2 %} disabled
                            {% endif %}>
                            {{ privilege.nom }}
                        </option>
                        {% endfor %}
                    </select>
                    {% endif %}
                    
                    {% if session.user_id == user.id %}
                    <input type="hidden" name="username" id="username" value="{{ session.user_username }}">
                    
                    <label for="password">Confirmer les modifications</label>
                    <input type="password" name="password" id="password">
                    {% endif %}
                </fieldset>
            </div>
            
            <nav class="nav-action">
                <!-- Annuler -->
                {% if session.user_id == user.id %}
                <a class="bouton annuler" href="{{ path }}/user/page">Annuler</a>
                {% else %}
                <a class="bouton annuler" href="{{ path }}/user/show/{{ user.id }}">Annuler</a>
                {% endif %}
                
                <!-- Enregistrer -->
                <input type="submit" class="bouton" value="Enregistrer">
            </nav>
        </form>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
