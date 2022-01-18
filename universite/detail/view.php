<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Universite</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Liste</a></li>
                        <li class="breadcrumb-item active">Détail</li>
                    </ol>
                </div>
                <h4 class="page-title">Détail Etudiant</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-5 col-lg-5">
            <div class="card">
                <div class="card-body" style="padding: 0.5rem !important;">
                    <h3>Université</h3>
                    <table class="table table-sm table-centered mb-0">
                        <tbody>
                            <tr><th>Université: </th><td style="font-weight: bold;"><?= ucwords($info['universite']) ?></td> </tr>
                            <tr><th>Département: </th><td style="font-weight: bold;"><?= ucwords($info['departement']) ?></td> </tr>
                            <tr><th>Spécialité : </th><td style="font-weight: bold;"><?= ucwords($info['specialite']) ?></td> </tr>
                            <tr><th>Niveau: </th><td style="font-weight: bold;"><?= ucwords($info['niveau']) ?></td></tr>
                            <tr><th>Type Diplôme: </th><td style="font-weight: bold;"><?= ucwords($info['type_diplome']) ?></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body" style="padding: 0.5rem !important;">
                    <h3>Etudiant</h3>
                    <table class="table table-sm table-centered mb-0">
                        <tbody>
                            <tr><th>Prénoms et nom: </th><td style="font-weight: bold;"><?= ucwords($info['prenom'].' '.$info['nom']) ?></td> </tr>
                            <tr><th>Matricule: </th><td style="font-weight: bold;"><?= $info['matricule'] ?></td> </tr>
                            <tr><th>Date de lieu : </th><td style="font-weight: bold;"><?= $info['date_naissance']. ', '.$info['lieu_naissance'] ?></td> </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        <div class="col-lg-7 col-xl-7">
            <?php if($is_diplome == 0): ?>
                <div class="card">
                    <div class="card-body" style="padding: 0.5rem 1rem 1.5rem 1rem !important;">
                        <form method="post" id="form_diplome" accept-charset="utf8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <p style="font-weight: bold;"><i class="uil-image"></i> Télécharger le diplôme</p>
                                        <input type="hidden" name="matricule" id="matricule" value="<?= $info['matricule'] ?>">
                                        <div class="row">
                                            <div class="col-3 col-md-3">
                                                <div id='logo' class="clearfix">
                                                    <div id="popoverLOGO"><img src="<?= LOGIN_ICON.'avatar.png'?>" /></div>
                                                </div>
                                            </div>
                                            <div class="col-9 col-md-6">
                                                <div class="logolist pull-left"><div id="probarLOGO"></div><div id="logolist"></div></div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12" style="margin-top: 20px !important;text-align: right;">
                                    <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="mdi mdi-content-save-edit-outline"></i> Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>                
                </div>
                <div class="card">
                    <div class="card-body" style="padding: 0.5rem 1rem 1.5rem 1rem !important;">
                        <div class="embed-responsive embed-responsive-1by1">
                            <embed src="<?= $isFile ?>" width=800 height=500 type='application/pdf'/>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="card">
                    <div class="card-body" style="padding: 0.5rem 1rem 1.5rem 1rem !important;">
                        <h4>Aperçu du diplôme</h4>
                        <div class="embed-responsive embed-responsive-1by1">
                            <embed src="<?= $mydip ?>" width=800 height=500 type='application/pdf'/>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
