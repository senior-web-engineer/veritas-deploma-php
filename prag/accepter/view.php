<!--Start Content-->
<div class="container-fluid">
    <!--start page title-->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Prag</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Liste</a></li>
                    </ol>
                </div>
                <h4 class="page-title"><i class="dripicons-time-reverse"></i> Liste des Etudiants acceptés</h4>
            </div>
        </div>
    </div>     
    <!--end page title--> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="departement" class="form-label">Département</label>
                                <select class="form-select form-control form-control-sm" data-require='yes' name="departement" id="departement">
                                    <option value="">Veuillez choisir</option>
                                    <option value="droit">Droit</option>
                                    <option value="informatique">Informatique</option>                        
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Spécialité </label>
                                <select class="form-select form-control form-control-sm" data-require='yes' name="specialite" id="specialite">
                                    <option value="">Veuillez choisir</option>
                                    <option value="droit des affaires">Droit des affaires</option>
                                    <option value="droit politique">Droit politique</option>                        
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Niveau d'étude </label>
                                <select class="form-select form-control form-control-sm" data-require='yes' name="niveau" id="niveau">
                                    <option value="">Veuillez choisir</option>
                                    <option value="licence 3">Licence 3</option>
                                    <option value="licence 4">Licence 4</option>                        
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Type de diplôme </label>
                            <select class="form-select form-control form-control-sm" data-require='yes' name="diplome" id="diplome">
                                <option value="">Veuillez choisir</option>
                                <option value="licence fondamentale">Licence fondamentale (BAC+3)</option>
                                <option value="licence professionnelle">Licence professionnelle (BAC+4)</option>                        
                                <option value="master">Master (BAC+5)</option> 
                                <option value="doctorat">Doctorat</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered w-100" id="content-datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>N°</th>                                    
                                    <th>Matricule</th>
                                    <th>Prénoms & nom</th>
                                    <th>Date de naissance</th>
                                    <th>Spécialité</th>
                                    <th>Niveau</th>
                                    <th>Type diplôme</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($listes as $liste):?>
                                    <tr onclick="navigate_(this)" data-clickurl="global" data-href="index.php?mdl=<?= $_GET['mdl']?>&&ctrl=detail&&matricule=<?= $liste['matricule'] ?>">
                                        <td><?= $i++ ?></td>
                                        <td><?= $liste['matricule'] ?></td>
                                        <td><?= ucfirst($liste['prenom']).' '.ucwords($liste['nom']) ?></td>
                                        <td><?= $liste['date_naissance'] ?></td>
                                        <td><?= $liste['specialite'] ?></td>
                                        <td><?= $liste['niveau'] ?></td>
                                        <td><?= $liste['type_diplome'] ?></td>
                                        <td>
                                        </td>
                                    </tr><?php 
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>