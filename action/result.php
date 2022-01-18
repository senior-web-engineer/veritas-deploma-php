<?php
	include_once '../core/config/init_ajax.php'; 

	$matricule = $_POST['matricule'];
	$prenom = $_POST['prenom'];
	$nom = $_POST['nom'];
	$universite = $_POST['universite'];

	$is_diplome = $model->countData(PREFIX.'diplome', ['fields'=>"COUNT(id)", 'conditions'=>['matricule'=>$matricule]]);
	
	if($is_diplome == 0):
		echo "<p style='text-align: center;color: red;font-size: xx-large;'>Les informations saisies n'a pas de diplôme ou n'existe pas dans la base de donnée</p>";
	else:
		$is_info = $model->countData(PREFIX.'etudiant', ['fields'=>"COUNT(id)", 'conditions'=>['matricule'=>$matricule, 'prenom'=>$prenom, 'nom'=>$nom, 'universite'=>$universite]]);

		if($is_info == 0):
			echo "<p style='text-align: center;color: red;font-size: xx-large;'>Les informations sont incorrectes </p>";
		else:
			$get = $model->singleData(PREFIX.'diplome', ['conditions'=>['matricule'=>$matricule]]);
			$mydip = 'diplome/'.$get['filename']; ?>
			<div class="card">
	            <div class="card-body" style="padding: 0.5rem 1rem 1.5rem 1rem !important;">
	                <h4>Aperçu du diplôme</h4>
	                <p>Université : <?= ucfirst($universite) ?></p>
	                <p>Matricule : <?= $matricule ?></p>
	                <p>Prénoms et Nom : <?= ucfirst($prenom). ' '.ucwords($nom) ?></p>
	                <div class="embed-responsive embed-responsive-1by1">
	                    <embed src="<?= $mydip ?>" width='80%' height='50%' type='application/pdf'/>
	                </div>
	            </div>
	        </div>
		<?php		
		endif;
		//echo "ok";
	endif;