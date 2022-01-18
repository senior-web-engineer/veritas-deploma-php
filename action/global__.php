<?php
  include_once '../core/config/init_ajax.php';
  $id = $_GET['id'];
  switch ($_GET['action']) 
  {
    case 'validation':
      $model->saveData(PREFIX.'etudiant', ['fields'=>['status'=>'accepter'], 'conditions'=>['universite'=>$id] ]);
    break;

    case 'refuser':
      $model->saveData(PREFIX.'etudiant', ['fields'=>['status'=>'refuser'], 'conditions'=>['universite'=>$id]]);
    break;

    case 'sigle_validation':
      $model->saveData(PREFIX.'etudiant', ['fields'=>['status'=>'accepter'], 'conditions'=>['matricule'=>$_GET['matricule']]]);
    break;

    case 'sigle_refuser':
      $model->saveData(PREFIX.'etudiant', ['fields'=>['status'=>'refuser'], 'conditions'=>['matricule'=>$_GET['matricule']]]);
    break;
  }