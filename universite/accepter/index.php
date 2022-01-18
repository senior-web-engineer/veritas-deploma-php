<?php 

$listes = $model->selectData(PREFIX.'etudiant', ['conditions'=>['universite'=>$_SESSION['adresse'], 'status'=>'accepter'], 'orderby'=>'matricule ASC']);

include 'view.php';