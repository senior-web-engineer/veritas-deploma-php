<?php 
/*

$produits = $model->selectData(PREFIX.'produits', ['orderby'=>'produit ASC']);

*/

$type_client = $model->selectData(PREFIX.'station_groupe', ['orderby'=>'nom ASC']);
$fournisseurs = $model->selectData(PREFIX.'fournisseurs', ['orderby'=>'nom ASC']);

$commande = $model->singleData(PREFIX.'commande', ['conditions'=>['id'=>$_GET['id_commande']]]);

$getCamion = $model->singleData(PREFIX.'camions', ['conditions'=>['id'=>$commande['camions']]]);

$items = $model->selectData(PREFIX.'commande_item', ['conditions'=>['id_commande'=>$commande['id']]]);

//$camions = $model->selectData(PREFIX.'camions', ['orderby'=>'immatriculation ASC']);

$compartiments = $model->selectData(PREFIX.'compartiment', ['conditions'=>['camion_id'=>$commande['camions']]]);

$stations = $model->selectData(PREFIX.'stations', ['orderby'=>'nom ASC']);

//$liste = $model->selectData(PREFIX.'commande', ['conditions'=>['status'=>'brouillon'], 'orderby'=>'id DESC']);

//$isFile = 'bon/'.$_GET['id_commande'].'.pdf';


$user = $model->singleData(PREFIX.'users', ['conditions'=>['id_users'=>$commande['users'] ]]);
$fournisseur = $model->singleData(PREFIX.'fournisseurs', ['conditions'=>['id'=>$commande['fournisseur'] ]]);
$brouillons = $model->selectData(PREFIX.'commande_item_brouillon',['conditions'=>['id_commande'=>$_GET['id_commande']]]);
include 'view.php';