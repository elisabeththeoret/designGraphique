{{ include('header.php', {title: 'Modifier Projet'}) }}
<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <h1>Modifier le projet</h1>
        
        <!-- Form Modifier -->
        <form action="{{ path }}/projet/update" method="post">
            <input type="hidden" name="id" value="{{ projet.id }}">
            
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Informations</h2></legend>
                    
                    <label for="titre">Titre du projet</label>
                    <input type="text" name="titre" id="titre" value="{{ projet.titre }}">
                    
                    <label for="client_id">Client</label>
                    <select name="client_id" id="client_id">
                        {% for client in clients %}
                        <option value="{{ client.id }}" {% if client.id == projet.client_id %} selected {% endif %}>{{ client.nom }}</option>
                        {% endfor %}
                    </select>
                    
                    <label for="categorie_id">Catégorie</label>
                    <select name="categorie_id" id="categorie_id">
                        {% for categorie in categories %}
                        <option value="{{ categorie.id }}" {% if categorie.id == projet.categorie_id %} selected {% endif %}>{{ categorie.nom }}</option>
                        {% endfor %}
                    </select>

                    <label for="description">Description</label>
                    <textarea name="description" id="description">{{ projet.description }}</textarea>
                </fieldset>
            </div>
                
            <nav class="nav-action">
                <!-- Annuler -->
                <a class="bouton annuler" href="{{ path }}/projet/show/{{ projet.id }}">Annuler</a>
                
                <!-- Enregistrer -->
                <input type="submit" class="bouton" value="Enregistrer">
            </nav>
        </form>
    </main>
</body>
</html>
