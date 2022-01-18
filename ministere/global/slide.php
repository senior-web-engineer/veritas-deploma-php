<?php  $stations = $model->selectData(PREFIX.'stations', ['orderby'=>'nom ASC']); ?>
<div class="left-side-menu">
    <div class="h-100" id="left-side-menu-container" data-simplebar>
        <a href="#" class="logo text-center">
            <span class="logo-lg"><img src="assets/images/logo.png" alt="" height="50" id="side-main-logo"></span>
            <span class="logo-sm"><img src="assets/images/logo.png" alt="" height="50" id="side-sm-main-logo"></span>
        </a>
        <ul class="metismenu side-nav">
            <li class="side-nav-title side-nav-item">Apps menu ministère</li>
            
            <!--li class="side-nav-item <?php if($_GET['mdl'] == 'dashboard') echo 'mm-active'; ?>">
                <a href="index.php?mdl=ministere&&ctrl=dashboard" class="side-nav-link <?php if($_GET['mdl'] == 'dashboard') echo 'active'; ?>">
                    <i class="uil-home-alt"></i><span> Tableau de bord </span>
                </a>
            </li-->
            <li class="side-nav-item <?php if($_GET['ctrl'] == 'attente') echo 'mm-active'; ?>">
                <a href="index.php?mdl=ministere&&ctrl=attente" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'attente') echo 'active'; ?>">
                    <i class="mdi mdi-gender-transgender"></i><span> Liste en validation </span>
                </a>
            </li>
            <li class="side-nav-item <?php if($_GET['ctrl'] == 'accepter') echo 'mm-active'; ?>">
                <a href="index.php?mdl=ministere&&ctrl=accepter" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'accepter') echo 'active'; ?>">
                    <i class="mdi mdi-gender-transgender"></i><span> Liste validés </span>
                </a>
            </li>
            <li class="side-nav-item <?php if($_GET['ctrl'] == 'verification') echo 'mm-active'; ?>">
                <a href="index.php?mdl=ministere&&ctrl=verification" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'verification') echo 'active'; ?>">
                    <i class="mdi mdi-gas-station"></i><span> Vérification </span>
                </a>
            </li>

            <li class="side-nav-item <?php if($_GET['ctrl'] == 'universite') echo 'mm-active'; ?>">
                <a href="#index.php?mdl=ministere&&ctrl=universite&&filtre=filtre" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'universite') echo 'active'; ?>">
                    <i class="mdi mdi-gas-station"></i><span> Universités </span>
                </a>
            </li>

            <li class="side-nav-item <?php if($_GET['ctrl'] == 'fournisseur' OR $_GET['ctrl']=='supplier_add') echo 'mm-active'; ?>">
                <a href="#index.php?mdl=ministere&&ctrl=fournisseur" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'fournisseur' OR $_GET['ctrl']=='supplier_add') echo 'active'; ?>">
                    <i class="mdi mdi-account-supervisor-outline"></i><span> Chat </span>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>