<?php       
	
    if(empty($_SESSION['id_users']) && $_GET['mdl']<>'auth') 
    {
        header("Location:index.php");  
    }
    //Inclusion du fichier de configuration (qui définit des constantes)
    require 'config.php';
    include 'include.php';