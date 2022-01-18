<?php 

$listes = $model->selectData(PREFIX.'etudiant', ['conditions'=>['status'=>'accepter'], 'orderby'=>'matricule ASC']);

include 'view.php';