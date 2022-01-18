<?php        
    include_once 'core/config/config.php';    		
    include_once 'core/libs/connectPDO.php';    		
    include_once 'modeles/model.php';    
    include_once 'core/libs/utils.php';    
    include_once 'core/libs/connection.php';    
	$connect = new Connection(NULL, NULL);
	$connect->disconnect();