<?php include_once '../core/config/init_ajax.php'; ?>	
<div class="modal-header">
    <h4 class="modal-title" id="standard-modalLabel"><i class='uil-home'></i> Aperçu </h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
	<?php $fileInfo = pathinfo($_GET['url']);
	switch($fileInfo['extension'])
	{
	    case'jpg':
	    case'jpeg':
	    case'png':
		    echo '<img style="width:100%; height:auto" src="tmp/'.$_GET['id'].'.'.$fileInfo['extension'].'" />';		
		break;
		case'pdf':
			echo' <iframe src="tmp/'.$_GET['id'].'.'.$fileInfo['extension'].'" style="width:100%; height:500px;" frameborder="0"></iframe>';
		break;
	} ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-undo"></i> Fermer</button>
</div>   