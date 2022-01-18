<form method="post" id="export_excel" enctype='multipart/form-data' accept-charset="utf8">
    <div class="modal-header">
        <h4 class="modal-title" id="standard-modalLabel"><i class='uil-car'></i> Télécharger la liste des étudiants</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="departement" class="form-label">Département</label>
                    <select class="form-select form-control form-control-sm" data-require='yes' name="departement" id="departement">
                        <option value="">Veuillez choisir</option>
                        <option value="droit">Droit</option>
                        <option value="informatique">Informatique</option>                        
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Spécialité </label>
                    <select class="form-select form-control form-control-sm" data-require='yes' name="specialite" id="specialite">
                        <option value="">Veuillez choisir</option>
                        <option value="droit des affaires">Droit des affaires</option>
                        <option value="droit politique">Droit politique</option>                        
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Niveau d'étude </label>
                    <select class="form-select form-control form-control-sm" data-require='yes' name="niveau" id="niveau">
                        <option value="">Veuillez choisir</option>
                        <option value="licence 3">Licence 3</option>
                        <option value="licence 4">Licence 4</option>                        
                    </select>
                </div>
            </div>
            <div class="col-md-8">
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
        <div class="row">
            <div class="col-md-6">
                <label for="excel_file">Importer la liste des etudiants</label>
                <input type="file" name="excel_file" id="excel_file">
            </div>
        </div>
        <div id="message"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
    </div>
</form>