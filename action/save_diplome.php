<?php
	include_once '../core/config/init_ajax.php'; 

	$diplome = json_decode($_POST['logo'], true);
	$matricule = $_POST['matricule'];

	if($diplome != ''):
		foreach($diplome as $av):
            $log = $av['hn'].'.'.$av['ext'];
            if(file_exists('../tmp/'.$log)):
                $util->moveFile('../tmp/'.$log,  '../diplome/'.$log);
				$model->saveData(PREFIX.'diplome', ['fields'=>['matricule'=>$matricule, 'filename'=>$log, 'create_at'=>date('Y-m-d H:i:s'), 'update_at'=>date('Y-m-d H:i:s') ]]);  
                //rename('../assets/images/'.$log, '../assets/images/logo.png');
            endif;
        endforeach;
	endif;