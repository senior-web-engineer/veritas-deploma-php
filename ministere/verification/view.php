<!--Start Content-->
<div class="container-fluid">
    <!--start page title-->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ministère</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Liste</a></li>
                    </ol>
                </div>
                <h4 class="page-title"><i class="dripicons-time-reverse"></i> Vérification de diplôme</h4>
            </div>
        </div>
    </div>     
    <!--end page title--> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="form_verification" accept-charset="utf8">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="matricule" class="form-label">Matricule <span class="text-danger">*</span></label>
                                    <input type="text" name="matricule" id="matricule" data-require='yes' class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="prenom" class="form-label">Prénoms <span class="text-danger">*</span></label>
                                    <input type="text" name="prenom" id="prenom" data-require='yes' class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input type="text" name="nom" id="nom" data-require='yes' class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="universite">Université <span class="text-danger">*</span> </label>
                                <select class="form-control form-control-sm" data-require='yes' name="universite" id="universite">
                                    <option value="">Veuillez choisir</option>
                                    <option value="UGANC">Université Gamal Abdel Nasser de Conakry</option>
                                    <option value="UGLC">Université Général Lansana Conté</option>
                                    <option value="koffi">Université Koffi annan de Guinée</option>
                                    <option value="UNC">Université Nongo de Conakry</option>
                                    <option value="ULG">Université Libre de Guinée</option>
                                </select>
                            </div>
                            <div class="col-md-2" style="margin-top: 1.7rem !important;">
                                <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-content-save-edit-outline"></i> Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="resultat"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
