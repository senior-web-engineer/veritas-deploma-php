<?php
	include_once '../core/config/init_ajax.php'; 
	include('../core/libs_ext/PHPExcel/PHPExcel/IOFactory.php');
	include('../core/libs_ext/PHPExcel/PHPExcel/Shared/Date.php');

	if(!empty($_FILES['excel_file'])):

		$file_array = explode(".", $_FILES["excel_file"]['name']);
		$departement = $_POST['departement'];
		$specialite = $_POST['specialite'];
		$niveau = $_POST['niveau'];
		$diplome = $_POST['diplome'];

		if($departement !="" OR $specialite !="" OR $niveau !="" OR $diplome !=""):
			if(in_array($file_array[1], ['xls','XLS','xlsx','XLSX','xlt','XLT'])):
				$object = PHPExcel_IOFactory::load($_FILES["excel_file"]['tmp_name']);
				move_uploaded_file($_FILES['excel_file']['tmp_name'],'../file/'.$file_array[0].'.'.$file_array[1]); 

				foreach($object->getWorksheetIterator() as $worksheet):
					$highestRow = $worksheet->getHighestRow();
					for($row=3; $row<=$highestRow; $row++):
						$matricule = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$prenom  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$nom = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$dates  = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						$lieu = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
						$dep  = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
						$spe = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
						$lice  = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

						if(is_numeric($dates)) {
	        				$dateValue = PHPExcel_Shared_Date::ExcelToPHP($dates);
				            $date = date('d/m/Y', $dateValue);
	        			} else {
	        				$date = $dates;
	        			}

						$model->saveData(PREFIX.'etudiant', ['fields'=>['matricule'=>$matricule, 'prenom'=>$prenom, 'nom'=>$nom,
							'date_naissance'=>$date, 'lieu_naissance'=>$lieu, 'departement'=>$departement, 'specialite'=>$specialite, 'niveau'=>$niveau, 'type_diplome'=>$diplome, 'universite'=>$_SESSION['adresse'], 'status'=>'en valide'
					]]);
					endfor;
				endforeach;
				echo 'LA LISTE DES ETUDIANTS UPLOADER AVEC SUCCES';
			else:
				echo "<p class='text-danger' style='font-size:18px;font-weight:bold;font-family:sans-sherif;'> ATTENTION LE FORMAT DU FICHIER N'EST PAS PRIS EN CHARGE ): </p>";
			endif;
		else:
			echo "<p class='text-danger' style='font-size:18px;font-weight:bold;font-family:sans-sherif;'> VOUS AVEZ OUBLIER UN ELEMENT DU FORMULAIRE ): </p>";
		endif;
	endif;