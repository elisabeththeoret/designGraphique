<?php
    // class ModelPrivilege
    class ModelPrivilege extends CRUD{
        /**
         * propriétés
         * @protected { String } $table - Nom de la table db
         * @protected { String } $primaryKey - Clé primaire de la table
         */
        protected $table = "privilege";
        protected $primaryKey = "id";
    }
?>
