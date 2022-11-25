<?php
    // class ModelCategorie
    class ModelCategorie extends CRUD{
        /**
         * propriétés
         * @protected {String} $table - Nom de la table db
         * @protected {String} $primaryKey - Nom de la clé primaire db
         * @protected {Array} $fillable - Tableau des colonnes de la db
         */
        protected $table = "categorie";
        protected $primaryKey = "categorie_id";
        protected $fillable = ["categorie_id", "nom", "description"];
    }
?>

