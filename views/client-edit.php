{{ include('header.php', {title: 'Modifier Client'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <h1>Modifier le client</h1>
        
        <!-- Erreurs -->
        {% if errors %}
        <span class="errors">{{ errors | raw }}</span>
        {% endif %}
        
        <!-- Form Modifier -->
        <form action="{{ path }}/client/update" method="post">
            <input type="hidden" name="id" value="{{ client.id }}">
            
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Informations</h2></legend>
                    
                    <label for="nom">Nom de l'entreprise</label>
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
                    
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" value="{{ client.contact }}">
                    
                    <label for="courriel">Courriel</label>
                    <input type="email" name="courriel" id="courriel" value="{{ client.courriel }}">
                    
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ client.phone }}">
                </fieldset>
            </div>
                
            <nav class="nav-action">
                <!-- Annuler -->
                <a class="bouton annuler" href="{{ path }}/client/show/{{ client.id }}">Annuler</a>
                
                <!-- Enregistrer -->
                <input type="submit" class="bouton" value="Enregistrer">
            </nav>
        </form>
    </main>
</body>
</html>
