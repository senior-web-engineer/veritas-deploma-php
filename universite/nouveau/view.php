<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bon de commande</a></li>
                        <li class="breadcrumb-item active">Nouvel</li>
                    </ol>
                </div>
                <h4 class="page-title">Nouvel Bon de commande </h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <form role="form" id="form_bon_commande" accept-charset="utf8">
                <input type="hidden" id="action" name="action" value="new">
                <div class="card" style="margin-bottom: 10px !important;">
                    <div class="card-body" style="padding: .3rem 1.5rem 0rem 1.5rem !important;">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8 col-6">
                                                <div class="form-group">
                                                    <label for="objet">Objet <span class="text-danger"> * </span></label>
                                                    <select class="custom-select custom-select-sm form-control form-control-sm" data-require='yes' name="objet" id="objet">
                                                        <option value="">Veuillez choisir</option>
                                                        <option value="bon de commande" selected>Bon de commande</option>
                                                        <option value="autre">Autre</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <!--div class="form-group">
                                                    <label for="date_commande">Date commande <span class="text-danger">*</span></label>
                                                    <input type="text" readonly name="date_commande" id="date_commande" value="<?= date('d/m/Y') ?>" data-require='yes' class="form-control form-control-sm">
                                                </div-->
                                                <div class="form-group">
                                                    <label for="date_commande">Date commande <span class="text-danger">*</span></label>
                                                    <input type="date" name="date_commande" id="date_commande" data-require='yes' class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4 col-4">
                                                <div class="form-group">
                                                    <label for="client">Client <span class="text-danger"> * </span></label>
                                                    <select name="client" class="custom-select custom-select-sm form-control form-control-sm" id="client" data-require='yes' data-min-length='1'>
                                                        <option value="">Choisir</option>
                                                        <?php foreach($type_client as $t): ?>
                                                            <option value="<?= $t['id'] ?>">S.B.S <?= strtoupper($t['nom']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="taille_mode" class="col-md-8 col-8">
                                                <div class="form-group">
                                                    <label for="mode_paiement">Mode Paiement <span class="text-danger">*</span></label>
                                                    <select name="mode_paiement" class="custom-select custom-select-sm form-control form-control-sm" data-require='yes' id="mode_paiement">
                                                        <option value="">Choisir</option>
                                                        <option value="espece">Espèce</option>
                                                        <option value="cheque">Chèque</option>
                                                        <option value="virement">Virement</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="dd" class="hidden col-md-4 col-4">
                                                <div class="form-group">
                                                    <label for="opt"></label>
                                                    <input name="opt" type="text" id="opt" data-require='yes' class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <div class="form-group">
                                                    <label for="obs">Type destination <span class="text-danger">*</span></label>
                                                    <select class="form-control form-control-sm" name="des" id="des" data-require='yes'>
                                                        <option value="">Veuillez choisir</option>
                                                        <option value="multi">Multi</option>
                                                        <option value="unique">Unique</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="st" class="hidden col-md-6 col-6">
                                                <div class="form-group">
                                                    <label for="obs">Station</label>
                                                    <select class="form-control form-control-sm" name="station_id" id="station_id" data-min-length='1'>
                                                        <option value="">Veuillez choisir</option>
                                                        <?php foreach($stations as $s): ?>
                                                            <option value="<?= $s['nom'] ?>"><?= ucwords($s['nom']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 col-6">
                                                <div class="form-group">
                                                    <label for="fournisseur">Fournisseur <span class="text-danger"> * </span></label>
                                                    <select name="fournisseur" class="custom-select custom-select-sm form-control form-control-sm" id="fournisseur" data-require='yes' data-min-length='1'>
                                                        <option value="">Veuillez choisir</option>
                                                        <?php foreach($fournisseurs as $t): ?>
                                                            <option value="<?= $t['id'] ?>"><?= strtoupper($t['nom']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-12 col-6">
                                                <div class="form-group">
                                                    <label for="obs">Observation</label>
                                                    <input name="obs" type="text" id="obs" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <div class="form-group">
                                                    <label for="pr">Type produit <span class="text-danger">*</span></label>
                                                    <select class="form-control form-control-sm" id="pr" name="pr" data-require='yes'>
                                                        <option value="">Veuillez choisir</option>
                                                        <option value="mixte">Mixte</option>
                                                        <option value="unique">Unique</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="stpr" class="hidden col-md-6 col-6">
                                                <div class="form-group">
                                                    <label for="pro">Produit</label>
                                                    <select class="form-control form-control-sm" name="pro" id="pro">
                                                        <option value="">Veuillez choisir</option>
                                                        <option value="essence">Essence</option>
                                                        <option value="gasoil">Gasoil</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-bottom: 10px !important;">
                    <div class="card-body" style="padding: 1.5rem 1.5rem 1.5rem 1.5rem !important;">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="chose_camion">Camion <span class="text-danger">*</span></label>
                                            <select data-require='yes' data-min-length='1' class="camion custom-select custom-select-sm form-control form-control-sm" name="chose_camion" id="chose_camion">
                                                <option value="">Veuillez choisir</option>
                                                <?php foreach($camions as $c): ?>
                                                    <option value="<?= $c['id'] ?>"><?= strtoupper($c['immatriculation']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php $j=0; ?>
                                <input type="hidden" id="ligne_station" value='<?php foreach($stations as $s): if($j<>0)echo','?><?=$s['nom']?><?php $j++;endforeach; ?>' class="form-control form-control-sm">
                                    
                                <div id="list_comp" class="row"></div>
                                
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 20px !important;text-align: right;">
                                        <button type="submit" name="submit" class="btn btn-success"><i class="mdi mdi-content-save-edit-outline"></i> Enregistrer la commande</button>
                                        <!--button type="reset" class="btn btn-danger btn-sm"><i class="dripicons-clockwise"></i> Annuler</button-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>