<?php
    include $_GET['mdl'].'/global/init.php';
    ob_start();
    if(!empty($_GET['ctrl'])) 
    { 
        $controleur = dirname(__FILE__).'/'.$_GET['ctrl'].'/'; 
        $action = (!empty($_GET['run'])) ? $_GET['run'].'.php' :'index.php';
        
        if (is_file($controleur.$action)) 
        { 
            include $controleur.$action; 
        }
        else 
        { 
            $_GET['mdl'] = 'e404'; 
            $_GET['ctrl'] = '404'; 
            header('Location:index.php?mdl='.$_GET['mdl'].'&&ctrl='.$_GET['ctrl']); 
            include $controleur; 
        }
    }
    else { $_GET['ctrl'] = 'login'; $controleur = dirname(__FILE__).'/'.$_GET['ctrl'].'/index.php'; include $controleur; }
    $contenu = ob_get_clean();
    echo $contenu;
?>	   