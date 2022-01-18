<?php
    /**
    * Classe implémentant le singleton pour PDO
    * @author Diakite
    */
    class PDO2 extends PDO 
    {
        private static $_instance;
        /* Constructeur : héritage public obligatoire par héritage de PDO*/
        public function __construct() {}
        // End of PDO2::__construct() */
        /* Singleton */
        public static function getInstance() 
        {
            if (!isset(self::$_instance)) 
            {
                try {
				    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
                    self::$_instance = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD, $options);						
                } catch (PDOException $e) {
                    echo $e;
				}
            }
            return self::$_instance;
        }
        // End of PDO2::getInstance() */
    }

    class PDO3 extends PDO 
    {
        private static $_instance;
        /* Constructeur : héritage public obligatoire par héritage de PDO*/
        public function __construct() {}
        // End of PDO2::__construct() */
        /* Singleton */
        public static function getInstance() 
        {
            if (!isset(self::$_instance)) 
            {
                try {
                    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
                    self::$_instance = new PDO(SQL_DSN2, SQL_USERNAME2, SQL_PASSWORD2, $options);                      
                } catch (PDOException $e) {
                    echo $e;
                }
            }
            return self::$_instance;
        }
        // End of PDO2::getInstance() */
    }
    // end of file */