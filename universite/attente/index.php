<?php 

$listes = $model->selectData(PREFIX.'etudiant', ['conditions'=>['universite'=>$_SESSION['adresse'], 'status'=>'en valide'], 'orderby'=>'matricule ASC']);

include 'view.php';