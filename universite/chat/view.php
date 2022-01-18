<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bon de commande</a></li>
                        <li class="breadcrumb-item active">Validation</li>
                    </ol>
                </div>
                <h4 class="page-title">Validation de Bon de commande </h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card" style="margin-bottom: 10px !important;">
                <div class="card-body" style="padding: .3rem 1.5rem 0rem 1.5rem !important;">
                    <div style="float:right;">
                        <button id="validation_bon_commande" data-id="<?= $_GET['id_commande'] ?>" class="btn btn-success btn-sm"><i class="mdi mdi-content-save-edit-outline"></i> Validation </button>
                        
                        <button onclick="navigate_(this)" data-clickurl='global' data-href="index.php?mdl=commande&&ctrl=modifier&&id_commande=<?= $_GET['id_commande'] ?>" class="btn btn-warning btn-sm"><i class="mdi mdi-content-save-edit-outline"></i> Modification</button>

                        <button data-toggle="modal" data-target="#myModalAlert" onclick="loadModal('myModalAlert','modal-sm',{file:<?php echo'\'action/alert_content.php?w=supprimer_bon_brouillon&id='.$_GET['id_commande'].'\'';?>, onSuccess : function(){ deleteGeneral();}})" class="btn btn-danger btn-sm"><i class="uil uil-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card" style="margin-bottom: 10px !important;">
                <div class="card-body" style="padding: .3rem 1.5rem 0rem 1.5rem !important;">
                    <table class="table table-sm table-centered mb-0">
                        <tbody>
                            <tr><th>Status : </th> <td><span class="badge badge-outline-danger badge-pill">En validation</span></td></tr>
                            <tr><th>Emetteur : </th> <td><?= ucwords($user['nom_users']) ?></td></tr>
                            <tr><th>Date commande :</th> <td><?= ucwords($commande['commande_at']) ?></td> </tr>    
                            <tr><th>Fournisseur : </th> <td><?= ucwords($fournisseur['raison_sociale']) ?></span></td> </tr>
                            <tr><th>Mode Paiement : </th> <td><?= ucwords($commande['mode']).' - '.strtoupper($commande['opt']) ?></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card" style="margin-bottom: 10px !important;">
                <div class="card-body" style="padding: .3rem 1.5rem 0rem 1.5rem !important;">
                    <table class="table table-sm table-centered mb-0">
                        <tbody>
                            <tr><th>Type Destination : </th> <td><?= ucwords($commande['type_destination']) ?></td></tr>
                            <tr><th>Type Produit : </th> <td><?= ucwords($commande['type_produit']) ?></td></tr>
                            <tr><th>Camion : </th> <td><?= ucwords($getCamion['immatriculation']) ?></td></tr>
                            <tr><th>Capacité : </th> <td><?= number_format($getCamion['capacite'],'0','.',' ').' Litres' ?></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card" style="margin-bottom: 10px !important;">
                <div class="card-body" style="padding: .3rem 1.5rem 0rem 1.5rem !important;">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <table class="table table-sm table-centered mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Compartiment</th>
                                        <th>Quantité</th>
                                        <th>Destination</th>
                                        <th>Produit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($brouillons as $b): 
                                        $station =  $model->singleData(PREFIX.'stations', ['conditions'=>['id'=>$b['stations']]]);
                                        ?>
                                        <tr>
                                            <td><?= $b['compartiment'] ?></td>
                                            <td><?= $b['qty'] ?></td>
                                            <td><?= ucwords($station['nom']) ?></td>
                                            <td><?= $b['produit'] ?></td>
                                        </tr>   
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>