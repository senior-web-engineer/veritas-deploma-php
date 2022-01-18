<?php
  //@ini_set('memory_limit', -1);
  header('content-type: text/html; charset=utf-8');
  session_start();
  include 'core/config/init.php';
  ob_start();

  if(!empty($_GET['mdl']) && !empty($_GET['ctrl'])):
    $module = dirname(__FILE__).'/'.$_GET['mdl'].'/index.php';
    if (is_file($module)):
      include $module;
    else: 
      header('Location:index.php?mdl=auth&&ctrl=login');
    endif;  
  else:
    header('Location:index.php?mdl=auth&&ctrl=login');
  endif;
  $contenu = ob_get_clean();
  // Début du code HTML
  include 'core/config/head.php';
  //echo $_SESSION['last_time_session'];
  echo $contenu;
  include 'core/config/foot.php';
  // Fin du code HTML