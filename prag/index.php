<?php
    include $_GET['mdl'].'/global/init.php';
    ob_start();
    // Si un controleur est specifié, on regarde s'il existe
    if(!empty($_GET['ctrl'])):
        $controleur = dirname(__FILE__).'/'.$_GET['ctrl'].'/';
        $action = (!empty($_GET['run'])) ? $_GET['run'].'.php' :'index.php';
        if (is_file($controleur.$action)):
            include $controleur.$action;
        else:
            $_GET['mdl'] = 'core';
		    $_GET['ctrl'] = 'e404';
			header('Location:index.php?mdl='.$_GET['mdl'].'&&ctrl='.$_GET['ctrl']);
            include $controleur;
		endif;
    else:
        $_GET['ctrl'] = 'login';
        $controleur = dirname(__FILE__).'/'.$_GET['ctrl'].'/index.php';
        include $controleur;
    endif;
    $contenu = ob_get_clean();
    echo $contenu;
?>	   