<?php
  header( 'content-type: text/html; charset=utf-8');
  session_start(); 
  // Identifiants pour la base de données. Nécessaires a PDO2.
  include 'db.php';  
  define('CHEMIN_MODELE', '../modeles/');
  define('CHEMIN_LIB', '../core/libs/');
  define('LOGIN_ICON', 'assets/images/');
  define('AVATAR', LOGIN_ICON.'users/');
  define('PREFIX', 'sbs_');