<?php
    // class ModelFacture
    class ModelFacture extends CRUD{
        /**
         * propriétés
         * @protected { String } $table - Nom de la table db
         * @protected { String } $primaryKey - Clé primaire de la table
         * 
         * @protected { Array } $fillable - Tableau des colonnes de la db
         * @protected { String } $render - Ce qui est retourné dans le tableau à afficher
         */
        protected $table = "facture";
        protected $primaryKey = "id";
        
        protected $fillable = ["id", "date", "projet_id"];
        protected $render = ["facture.id", "facture.date", "projet.nom AS projet", "categorie.nom AS categorie"];
    }
?>
