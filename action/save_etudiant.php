<?php
	include_once '../core/config/init_ajax.php'; 
	
	$matricule = $_POST['matricule'];
	$prenom = $_POST['prenom'];
	$nom = $_POST['nom'];

	$date_naissance = $_POST['date_naissance'];
	$lieu = $_POST['lieu'];
	$departement = $_POST['departement'];
	$specialite = $_POST['specialite'];
	$niveau = $_POST['niveau'];
	$diplome = $_POST['diplome'];

	$model->saveData(PREFIX.'etudiant', ['fields'=>['matricule'=>$matricule, 'prenom'=>$prenom, 'nom'=>$nom, 'date_naissance'=>$date_naissance, 'lieu_naissance'=>$lieu, 'departement'=>$departement, 'specialite'=>$specialite, 'niveau'=>$niveau, 'type_diplome'=>$diplome, 'universite'=>$_SESSION['adresse'], 'status'=>'en valide']]);
