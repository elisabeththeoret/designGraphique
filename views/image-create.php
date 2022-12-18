{{ include('header.php', { title:'Ajouter une image' }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1>Ajouter une imge</h1>
        </header>
        
        <!-- Erreurs -->
        {% if errors %}
        <span class="errors">{{ errors | raw }}</span>
        {% endif %}
        
        <!-- Form Modifier -->
        <form action="{{ path }}/image/store" method="post" enctype="multipart/form-data">
            <div class="flex-row">
                <fieldset class="flex-col">
                    <legend><h2>Informations</h2></legend>
                    
                    <label for="fichier">Image*</label>
                    <input type="file" name="fichier" id="fichier">
                    
                    <label for="projet">Pour le projet*</label>
                    <select name="projet_id" id="projet">
                        {% if image.projet_id == 0 %}
                        <option value="">Sélectionner le projet</option>
                        {% endif %}
                        {% for projet in projets %}
                        <option value="{{ projet.id }}" {% if projet.id == image.projet_id %} selected {% endif %}>{{ projet.titre }}</option>
                        {% endfor %}
                    </select>
                    
                    <label for="description">Description</label>
                    <textarea name="description" id="description">{{ image.description }}</textarea>
                </fieldset>
            </div>
            
            <nav class="nav-action">
                <!-- Annuler -->
                <a class="bouton annuler" href="{{ path }}/projet/show/{{ image.id }}">Annuler</a>
                
                <!-- Ajouter -->
                <input type="submit" class="bouton" value="Ajouter">
            </nav>
        </form>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>
