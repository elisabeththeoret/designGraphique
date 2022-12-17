{{ include('header.php', { title:'Créer un projet' }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>Créer un projet</h1>
        </header>
        
        <!-- Erreurs -->
        {% if errors %}
        <span class="errors">{{ errors | raw }}</span>
        {% endif %}
        
        <!-- Form Modifier -->
        <form action="{{ path }}/projet/store" method="post">
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Informations</h2></legend>
                    
                    <label for="titre">Titre du projet</label>
                    <input type="text" name="titre" id="titre" value="{{ projet.titre }}">
                    
                    <label for="client">Client</label>
                    <select name="client_id" id="client">
                        <option value="">Sélectionner un client</option>
                        {% for client in clients %}
                        <option value="{{ client.id }}" {% if client.id == projet.client_id %} selected {% endif %}>{{ client.nom }}</option>
                        {% endfor %}
                    </select>
                    
                    <label for="categorie">Catégorie</label>
                    <select name="categorie_id" id="categorie">
                        <option value="">Sélectionner une catégorie</option>
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
                <a class="bouton annuler" href="{{ path }}/projet">Annuler</a>
                
                <!-- Créer -->
                <input type="submit" class="bouton" value="Créer">
            </nav>
        </form>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
