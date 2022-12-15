<?php
    // class ModelCategorie
    class ModelCategorie extends CRUD{
        /**
         * propriétés
         * @protected { String } $table - Nom de la table db
         * @protected { String } $primaryKey - Clé primaire de la table
         * 
         * @protected { Array } $fillable - Tableau des colonnes de la db
         * @protected { String } $render - Ce qui est retourné dans le tableau à afficher
         */
        protected $table = "categorie";
        protected $primaryKey = "id";
        
        protected $fillable = ["id", "nom", "description"];
        protected $render = "categorie.id, categorie.nom, categorie.description, service";

    }
?>
