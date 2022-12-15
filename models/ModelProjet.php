<?php
    // class ModelProjet
    class ModelProjet extends CRUD{
        /**
         * propriétés
         * @protected { String } $table - Nom de la table db
         * @protected { String } $primaryKey - Clé primaire de la table
         * 
         * @protected { Array } $fillable - Tableau des colonnes de la db
         * @protected { String } $render - Ce qui est retourné dans le tableau à afficher
         */
        protected $table = "projet";
        protected $primaryKey = "id";
        
        protected $fillable = ["id", "titre", "description", "client_id", "categorie_id"];
        protected $render = "projet.id, projet.titre, projet.description, client.nom AS client, categorie.nom AS categorie";
    }
?>
