<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bon de commande</a></li>
                        <li class="breadcrumb-item active">Nouveau</li>
                    </ol>
                </div>
                <h4 class="page-title">Ajouter un bon de commande </h4>
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
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="objet">Objet <span class="text-danger"> * </span></label>
                                                    <select class="custom-select custom-select-sm form-control form-control-sm" data-require='yes' name="objet" id="objet">
                                                        <option value="">Veuillez choisir</option>
                                                        <option value="bon de commande" selected>Bon de commande</option>
                                                        <option value="autre">Autre</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="date_commande">Date commande <span class="text-danger">*</span></label>
                                                    <input type="text" name="date_commande" id="date_commande" value="<?= date('d/m/Y') ?>" data-require='yes' class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="client">Client <span class="text-danger"> * </span></label>
                                                    <select name="client" class="custom-select custom-select-sm form-control form-control-sm" id="client" data-require='yes' data-min-length='1'>
                                                        <option value="">Veuillez choisir</option>
                                                        <?php foreach($type_client as $t): ?>
                                                            <option value="<?= $t['id'] ?>">S.B.S <?= strtoupper($t['nom']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div id="taille_mode" class="col-md-12">
                                                <div class="form-group">
                                                    <label for="mode_paiement">Mode de paiement <span class="text-danger">*</span></label>
                                                    <select name="mode_paiement" class="custom-select custom-select-sm form-control form-control-sm" data-require='yes' id="mode_paiement">
                                                        <option value="">Veuillez choisir</option>
                                                        <option value="espece">Espèce</option>
                                                        <option value="cheque">Chèque</option>
                                                        <option value="virement">Virement</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="dd" class="hidden col-md-6">
                                                <div class="form-group">
                                                    <label for="opt"></label>
                                                    <input name="opt" type="text" id="opt" data-require='yes' class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="row">
                                            <div class="col-md-12">
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
                                       </div>
                                       <div class="row">
                                            <div id="info_fournisseur"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="obs">Observation</label>
                                                    <textarea name="obs" class="form-control form-control-sm" id="obs" cols="5" placeholder="Observation..."></textarea>
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
                    <div class="card-body" style="padding: .3rem 1.5rem 0rem 1.5rem !important;">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="25%" align="left" style="padding:8px 10px !important;">Destination</th>
                                            <th width="20%"style="padding:8px 10px !important;">Camion</th>
                                            <th width="20%" style="padding:8px 10px !important;">Produit</th>
                                            <th width="15%" style="text-align:right; padding:8px 10px !important;">Qté</th>
                                            <th width="15%" style="text-align:right;padding:8px 10px !important;">Prix unitaire</th>
                                            <th style="text-align: center; padding:8px 10px !important;"><i class="dripicons-gear"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select required class="custom-select custom-select-sm destination form-control form-control-sm" name="destination[]">
                                                    <option value=""></option>
                                                </select>
                                            </td>
                                            <td>
                                                <select required class="custom-select custom-select-sm form-control form-control-sm" name="camion[]">
                                                    <option value=""></option>
                                                    <?php foreach($camions as $c): ?>
                                                        <option value="<?= $c['id'] ?>"><?= strtoupper($c['immatriculation']) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select required class="custom-select custom-select-sm produit form-control form-control-sm" data-pos='0' name="produit[]">
                                                    <option value=""></option>
                                                    <?php foreach($produits as $p): ?>
                                                        <option value="<?= $p['id'] ?>"><?= strtoupper($p['produit']) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input required type="number" name="qty[]" placeholder="Quantité" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input required type="text" name="pu[]" id="pu0" placeholder="Prix unitaire" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <span id="add" class="btn btn-primary btn-sm"><i class="uil-plus"></i></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 20px !important;text-align: right;">
                                        <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="mdi mdi-content-save-edit-outline"></i> Enregistrer</button>
                                        <!--button id="trash" class="btn btn-primary btn-sm"><i class="dripicons-trash"></i> Enregistrer dans brouillon</button-->
                                        <button type="reset" class="btn btn-danger btn-sm"><i class="dripicons-clockwise"></i> Annuler</button>
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