{{ include('header.php', { title:'Ajouter un client' }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>Ajouter un client</h1>
        </header>
        
        <!-- Erreurs -->
        {% if errors %}
        <span class="errors">{{ errors | raw }}</span>
        {% endif %}
        
        <!-- Form Créer -->
        <form action="{{ path }}/client/store" method="post">
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Informations</h2></legend>
                    
                    <label for="nom">Nom de l'entreprise*</label>
                    <input type="text" name="nom" id="nom" value="{{ client.nom }}">
                    
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse" value="{{ client.adresse }}">
                    
                    <label for="ville">Ville</label>
                    <select name="ville_id" id="ville">
                        {% for ville in villes %}
                        <option value="{{ ville.id }}" {% if ville.id == client.ville_id %} selected {% endif %}>{{ ville.nom }}</option>
                        {% endfor %}
                    </select>
                    
                    <label for="codePostal">Code postal</label>
                    <input type="text" name="codePostal" id="codePostal" value="{{ client.codePostal }}">
                </fieldset>
                
                <fieldset class="flex-col">
                    <legend><h2>Personne contact</h2></legend>
                    
                    <label for="contact">Contact*</label>
                    <input type="text" name="contact" id="contact" value="{{ client.contact }}">
                    
                    <label for="courriel">Courriel*</label>
                    <input type="email" name="courriel" id="courriel" value="{{ client.courriel }}">
                    
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ client.phone }}">
                </fieldset>
            </div>
            
            <nav class="nav-action">
                <!-- Annuler -->
                <a class="bouton annuler" href="{{ path }}/client">Annuler</a>
                
                <!-- Créer -->
                <input type="submit" class="bouton" value="Créer">
            </nav>
        </form>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
