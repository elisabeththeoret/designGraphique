<?php
    // class ModelFacture
    class ModelFacture extends CRUD{
        /**
         * propriétés
         * @protected {String} $table - Nom de la table db
         * @protected {String} $primaryKey - Nom de la clé primaire db
         * @protected {Array} $fillable - Tableau des colonnes de la db
         */
        protected $table = "facture";
        protected $primaryKey = "id";
        protected $fillable = ["id", "date", "client_id", "projet_id"];
    }
?>

