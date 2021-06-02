<?php
    /**
     * Configuration SQL : Creation d'une connexion avec PDO
     * 
     * J'ai utilisé les class pour question de securité des identifiants de mon serveur.
     * Si vous etes en production elle vous sera tres benefique par contre en mode test/developpement/ local ce n'est pas nécessaire
     * Mais vaut meix garder de bonne habitudes
     */
    
    class DB {
        private $host = 'localhost';
        private $port = '3306';
        private $user = 'root';
        private $password = '';
        private $dbname = 'slim-api';

        public function connect () {
            $connect_str = "mysql:host=$this->host; dbname=$this->dbname";
            $conn = new PDO($connect_str, $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        }
    }