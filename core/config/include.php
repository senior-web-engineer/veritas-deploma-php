<?php
	ini_set('magic_quotes_runtime', 0);
   if(get_magic_quotes_gpc()):
      function remove_magic_quotes_gpc(&$value) 
      {
         $value = stripslashes($value);
      }	
      array_walk_recursive($_GET, 'remove_magic_quotes_gpc');
      array_walk_recursive($_POST, 'remove_magic_quotes_gpc');
      array_walk_recursive($_COOKIE, 'remove_magic_quotes_gpc');
   endif;
   require CHEMIN_MODELE.'model.php';
   // Inclusion des libs, potentiellement utile partout
   require_once CHEMIN_LIB.'ConnectPDO.php';
   require_once CHEMIN_LIB.'utils.php';
   require_once CHEMIN_LIB.'connection.php';
   require_once CHEMIN_LIB.'init_head.php';
   require_once CHEMIN_LIB.'backupMysql.php';
   //require_once CHEMIN_LIB.'myfpdf/generation.php';
	//Instantiation des classes, potentiellement utile partout
	$util        = new Util();
	$head        = new HEAD();
   //$t           = new GNS();
   $model       = new Model( PDO2::getInstance());
   $backup      = new BackupMysql(SQL_HOST, SQL_DBNAME, SQL_USERNAME, SQL_PASSWORD, "latin1", "C:\\back/", "backup");
   
   //define('ORDINATEUR', 'hp');
   
   //define('URL_DOC_CARGO', '../documents/cargaison/');
   //define('URL_DOC_EFFET', '../documents/effet/');
   //define('URL_DOC_AERIENNE', '../documents/aerienne/');
?>