<?php  
$id = $_GET['matricule'];

$info = $model->singleData(PREFIX.'etudiant', ['conditions'=>['matricule'=>$id]]);

$is_diplome = $model->countData(PREFIX.'diplome', ['fields'=>"COUNT(id)", 'conditions'=>['matricule'=>$id]]);
$get = $model->singleData(PREFIX.'diplome', ['conditions'=>['matricule'=>$id]]);

$isFile =  'diplome/tt.png';

$mydip = 'diplome/'.$get['filename'];

include 'view.php';