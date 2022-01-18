<?php
	include_once '../core/config/init_ajax.php';

	switch($_GET['w'])
    {
		case 'refuser':
			$fa = 'trash';$title = 'Annulation !';
			$txt = 'Vous voulez vraiment refuser la liste des Etudiants';
		break;

		case 'validation':
			$fa = 'check';$title = 'Validation !';
			$txt = 'Vous voulez vraiment valider cette liste ?';
		break;

		case 'sigle_refuser':
			$fa = 'trash';$title = 'Refuser !';
			$txt = 'Vous voulez vraiment refuser cet Etudiant';
		break;

		case 'sigle_validation':
			$fa = 'check';$title = 'Validation !';
			$txt = 'Vous voulez vraiment valider cet Etudiant ?';
		break;
	}
?>
<div class="modal-body p-4">
    <div class="text-center">
        <i class="dripicons-<?= $fa ?>" style="font-size: xx-large;" ></i>
        <h4 class="mt-2"><font style="vertical-align: inherit;"><?= $title ?></font></h4>
        <p class="mt-3"><font style="vertical-align: inherit;"><?= $txt ?> </font></p><br>
        <button type="button" class="btn btn-warning my-2" data-dismiss="modal" style="color: white;font-weight: bold;">
        	<i class="mdi mdi-undo-variant"></i> <b>Fermer</b>
        </button>
        <button data-action="<?= $_GET['w'] ?>" data-id="<?= $_GET['id'] ?>" data-matricule="<?= $_GET['matricule'] ?>" class="btn btn-light my-2 btnopt">
			<font style="vertical-align: inherit;"><i class="dripicons-trash"></i> <b>Continuer</b></font>
		</button>
    </div>
</div>
