<?php
  include 'db.php';
  // Chemins � utiliser pour acc�der aux librairies/vues/modeles....
  define('CHEMIN_LIB', 'core/libs/');
  define('CHEMIN_LIB_EXT', 'core/libs_ext/');
  define('CHEMIN_MODELE', 'modeles/');
  define('MENU', 'core/config/menu.php');	
  // Chemins � utiliser pour acc�der aux medias : imges, video....
  define('LOGIN_ICON', 'assets/images/'); 
  define('AVATAR', LOGIN_ICON.'users/');
  define('CSS', 'assets/css/'); 
  define('JS', 'assets/js/'); 
  define('CSS_VENDOR', CSS.'vendor/'); 
  define('JS_VENDOR', JS.'vendor/'); 
  define('MYJS', JS.'pages/'); 
  define('PREFIX', 'sbs_');