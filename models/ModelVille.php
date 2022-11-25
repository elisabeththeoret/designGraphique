<?php
    // class ModelVille
    class ModelVille extends CRUD{
        /**
         * propriétés
         * @protected {String} $table - Nom de la table db
         * @protected {String} $primaryKey - Nom de la clé primaire db
         * @protected {Array} $fillable - Tableau des colonnes de la db
         */
        protected $table = "ville";
        protected $primaryKey = "ville_id";
        protected $fillable = ["ville_id", "ville_nom"];
    }
?>

