<?php 

$listes = $model->selectData(PREFIX.'etudiant', ['conditions'=>['status'=>'en valide'], 'orderby'=>'matricule ASC']);

include 'view.php';