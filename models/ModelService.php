<?php
    // class ModelClient
    class ModelService extends CRUD{
        /**
         * propriétés
         * @protected {String} $table - Nom de la table db
         * @protected {String} $primaryKey - Nom de la clé primaire db
         * @protected {Array} $fillable - Tableau des colonnes de la db
         */
        protected $table = "service";
        protected $primaryKey = "service_id";
        protected $fillable = ["service_id", "nom", "description", "prix"];
    }
?>

