<?php 
$type_client = $model->selectData(PREFIX.'station_groupe', ['orderby'=>'nom ASC']);
$fournisseurs = $model->selectData(PREFIX.'fournisseurs', ['orderby'=>'nom ASC']);
$camions = $model->selectData(PREFIX.'camions', ['orderby'=>'immatriculation ASC']);
$produits = $model->selectData(PREFIX.'produits', ['orderby'=>'produit ASC']);

$stations = $model->selectData(PREFIX.'stations', ['orderby'=>'nom ASC']);

include 'view.php';