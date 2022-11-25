<?php
    // class ModelProjet
    class ModelProjet extends CRUD{
        /**
         * propriétés
         * @protected {String} $table - Nom de la table db
         * @protected {String} $primaryKey - Nom de la clé primaire db
         * @protected {Array} $fillable - Tableau des colonnes de la db
         */
        protected $table = "projet";
        protected $primaryKey = "projet_id";
        protected $fillable = ["projet_id", "titre", "description", "client_id", "categorie_id"];
    }
?>

