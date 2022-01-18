<div class="left-side-menu">
    <div class="h-100" id="left-side-menu-container" data-simplebar>
        <!-- LOGO -->
        <a href="#" class="logo text-center">
            <span class="logo-lg"><img src="assets/images/logo.png" alt="" height="50" id="side-main-logo"></span>
            <span class="logo-sm"><img src="assets/images/logo.png" alt="" height="50" id="side-sm-main-logo"></span>
        </a>
        <!--- Sidemenu -->
        <ul class="metismenu side-nav">
            <li class="side-nav-title side-nav-item">Apps menu université</li>
            <!--li class="side-nav-item <?php if($_GET['mdl'] == 'home') echo 'mm-active'; ?>">
                <a href="index.php?mdl=home&&ctrl=dashboard" class="side-nav-link <?php if($_GET['mdl'] == 'home') echo 'active'; ?>">
                    <i class="uil-home-alt"></i><span> Tableau de bord </span>
                </a>
            </li-->
            
            <li class="side-nav-item">
                <a  data-toggle="modal" data-target="#myModal" 
                    onclick="loadModal('myModal','modal-md',{file:'action/modal_televerser.php',onSuccess:function(){ universiteAfterAjax('televerser');}},{setView:false})" class="side-nav-link" style="cursor:pointer;">
                    <i class="mdi mdi-bike-fast"></i>
                    <span> Téléverser la liste</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-toggle="modal" data-target="#myModal" 
                    onclick="loadModal('myModal','modal-lg',{file:'action/modal_nouveau.php',onSuccess:function(){ universiteAfterAjax('nouveau');}},{setView:false})" class="side-nav-link" style="cursor:pointer;">
                    <i class="uil-notes"></i><span> Nouveau </span>
                </a>
            </li>
            <li class="side-nav-item <?php if($_GET['ctrl'] == 'attente') echo 'mm-active'; ?>">
                <a href="index.php?mdl=universite&&ctrl=attente" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'attente') echo 'active'; ?>">
                    <i class="mdi mdi-pier-crane"></i>
                    <span> Liste en attente </span>
                </a>
            </li>
            <li class="side-nav-item <?php if($_GET['ctrl'] == 'accepter') echo 'mm-active'; ?>">
                <a href="index.php?mdl=universite&&ctrl=accepter" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'accepter') echo 'active'; ?>">
                    <i class="mdi mdi-fire-truck"></i><span> Liste validé par MES</span>
                </a>
            </li>
            <li class="side-nav-item <?php if($_GET['ctrl'] == 'chat') echo 'mm-active'; ?>">
                <a href="#index.php?mdl=universite&&ctrl=chat" class="clickurl side-nav-link <?php if($_GET['ctrl'] == 'chat') echo 'active'; ?>">
                    <i class="mdi mdi-pier-crane"></i>
                    <span> Chat </span>
                </a>
            </li>
        </ul>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>