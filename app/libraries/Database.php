<?php
    /*
     * PDO Database Class
     * Connect to database
     * Create prepared Statements
     * Bind Values
     * Return rows and results
    */
    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;
        private $dbh;
        private $stmt;
        private $error;

        public function __construct() {
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            );
            // create PDO Instance
            try {
                $this->dbh = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass,$options);            
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        //Prepare Statement with query
        public function query($sql) {
            $this->stmt = $this->dbh->prepare($sql);
        }
        //Bind Values
        public function bind($param, $value, $type = null) {
            if(is_null($type)) {
                switch(true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                        break;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }
        // Execute the Prepared statment
        public function execute() {
            return $this->stmt->execute();
        }
        //Get Result set as array of objects
        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
        //Get single objects
        public function single(){
            $this->stmt->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }
        //Get row count
        public function rowCount(){
            return $this->stmt->rowCount();
        }

    }