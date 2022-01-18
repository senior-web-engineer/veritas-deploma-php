<?php  
	/*session_start();
    include_once '../../core/config/config.php';    		
    include_once '../../'.CHEMIN_LIB.'connectPDO.php';    		
    include_once '../../'.CHEMIN_MODELE.'model.php';    
    include_once '../../'.CHEMIN_LIB.'utils.php';    
    include_once '../../'.CHEMIN_LIB.'connection.php';
	$connect = new Connection($_POST['userid'], sha1($_POST['password']));
	//$model = new Model( PDO2::getInstance());
	if($connect->auth_passe()):
		if($_SESSION['active'] == 1):
		   	header('Location:../../index.php?mdl=commande&&ctrl=dashboard');
		else:
			header('Location:../../index.php?mdl=auth&&ctrl=login&&msg=error');
		endif;
	else:
		header('Location:../../index.php?mdl=auth&&ctrl=login&&msg=error');
	endif;*/