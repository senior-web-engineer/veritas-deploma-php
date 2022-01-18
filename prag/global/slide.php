<div class="left-side-menu">
    <div class="h-100" id="left-side-menu-container" data-simplebar>
        <a href="#" class="logo text-center">
            <span class="logo-lg"><img src="assets/images/logo.png" alt="" height="50" id="side-main-logo"></span>
            <span class="logo-sm"><img src="assets/images/logo.png" alt="" height="50" id="side-sm-main-logo"></span>
        </a>
        <ul class="metismenu side-nav">
            <li class="side-nav-title side-nav-item">Apps menu PRAG</li>
            
            <!--li class="side-nav-item <?php if($_GET['mdl'] == 'home') echo 'mm-active'; ?>">
                <a onclick='navigate_(this)' data-clickurl='global' data-href="index.php?mdl=home&&ctrl=dashboard" style="cursor: pointer;" role="button" class="clickurl side-nav-link <?php if($_GET['mdl'] == 'home') echo 'active'; ?>">
                    <i class="uil-home-alt"></i><span> Tableau de bord </span>
                </a>
            </li-->
            <li class="side-nav-item <?php if($_GET['ctrl'] == 'accepter') echo 'mm-active'; ?>">
                <a href="index.php?mdl=prag&&ctrl=accepter" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'accepter') echo 'active'; ?>">
                    <i class="mdi mdi-gender-transgender"></i><span> Liste validés </span>
                </a>
            </li>
            <li class="side-nav-item <?php if($_GET['ctrl'] == 'verification') echo 'mm-active'; ?>">
                <a href="index.php?mdl=prag&&ctrl=verification" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'verification') echo 'active'; ?>">
                    <i class="mdi mdi-gas-station"></i><span> Vérification </span>
                </a>
            </li>

            <li class="side-nav-item <?php if($_GET['ctrl'] == 'universite') echo 'mm-active'; ?>">
                <a href="#index.php?mdl=prag&&ctrl=universite" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'universite') echo 'active'; ?>">
                    <i class="mdi mdi-gas-station"></i><span> Universités </span>
                </a>
            </li>

            <li class="side-nav-item <?php if($_GET['ctrl'] == 'fournisseur' OR $_GET['ctrl']=='supplier_add') echo 'mm-active'; ?>">
                <a href="#index.php?mdl=prag&&ctrl=fournisseur" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'fournisseur' OR $_GET['ctrl']=='supplier_add') echo 'active'; ?>">
                    <i class="mdi mdi-account-supervisor-outline"></i><span> Chat </span>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>