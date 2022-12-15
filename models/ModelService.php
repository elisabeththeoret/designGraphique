<?php
    // class ModelService
    class ModelService extends CRUD{
        /**
         * propriétés
         * @protected { String } $table - Nom de la table db
         * @protected { String } $primaryKey - Clé primaire de la table
         * 
         * @protected { Array } $fillable - Tableau des colonnes de la db
         */
        protected $table = "service";
        protected $primaryKey = "id";
        
        protected $fillable = ["id", "nom", "description", "prix"];
    }
?>
