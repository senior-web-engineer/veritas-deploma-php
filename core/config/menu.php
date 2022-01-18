<?php
if($_SESSION['groupe'] == 'administrateur'): 
    $position = 'administrateur';
else:
    $position = $_SESSION['adresse'];
endif;
$mod = $model->singleData(PREFIX.'config', ['conditions'=>['id'=>1]]);
?>
<div class="content-page">
    <div class="content">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topbar-right-menu float-right mb-0">
                <!--Notification-->
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="dripicons-bell noti-icon"></i>
                        <span class="noti-icon-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    <a href="javascript: void(0);" class="text-dark">
                                        <small>Clear All</small>
                                    </a>
                                </span>Notification
                            </h5>
                        </div>
                        <div style="max-height: 230px;" data-simplebar>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Caleb Flakelar commented on Admin
                                    <small class="text-muted">1 min ago</small>
                                </p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info">
                                    <i class="mdi mdi-account-plus"></i>
                                </div>
                                <p class="notify-details">New user registered.
                                    <small class="text-muted">5 hours ago</small>
                                </p>
                            </a>
                        </div>
                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            View All
                        </a>
                    </div>
                </li>
                <!-- Profile utilisateur -->
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="account-user-avatar"> 
                            <img src="<?= AVATAR.'defaut.jpg' ?>" alt="user-image" class="rounded-circle">
                        </span>
                        <span>
                            <span class="account-user-name"><?= ucwords($_SESSION['nom_users']) ?></span>
                            <span class="account-position"><?= $position ?></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                        <!--item-->
                        <div class=" dropdown-header noti-title"><h6 class="text-overflow m-0">Bienvenue/Welcom !</h6></div>
                        <!--item-->
                        <a onclick="loadModal('myModal','modal-md',{file:'action/modal_profile.php?id=<?= $_SESSION['id_users'] ?>',onSuccess:function(){ profile('profile');}},{setView:false})" href="#" data-toggle="modal" data-target="#myModal" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle mr-1"></i>
                            <span>Mon Profile</span>
                        </a>
                        <!--item-->
                        <a onclick="loadModal('myModal','modal-md',{file:'action/modal_change_my_pwd.php?id=<?= $_SESSION['id_users'] ?>',onSuccess:function(){ profile('my_pwd');}},{setView:false})" href="#" data-toggle="modal" data-target="#myModal" class="dropdown-item notify-item">
                            <i class="mdi mdi-lock-outline mr-1"></i>
                            <span>Mon mot de passe</span>
                        </a>
                        <!--item-->
                        <a href="index.php?ctrl=login&&mdl=auth&&run=logout&&p=lnauthmodenormalizd" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout mr-1"></i>
                            <span>Se Deconnecter</span>
                        </a>
                    </div>
                </li>
            </ul>
            <button class="button-menu-mobile open-left disable-btn"><i class="mdi mdi-menu"></i></button>
            <div class="app-search">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Recherche...">
                        <span class="mdi mdi-magnify"></span>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Recherche</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end Topbar -->