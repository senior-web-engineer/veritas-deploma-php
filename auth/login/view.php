<?php  
    include_once 'core/config/config.php';            
    include_once CHEMIN_LIB.'connectPDO.php';          
    include_once CHEMIN_MODELE.'model.php';    
    include_once CHEMIN_LIB.'utils.php';    
    include_once CHEMIN_LIB.'connection.php';
    
    if(isset($_POST['submit'])):
        $connect = new Connection($_POST['userid'], sha1($_POST['password']));
        if($connect->auth_passe()):
            if($_SESSION['active'] == 1):
                session_start();
                //header('Location:index.php?mdl='.$_SESSION['groupe'].'&&ctrl=dashboard');
                header('Location:index.php?mdl='.$_SESSION['groupe'].'&&ctrl=accepter');
            else:
                header('Location:index.php?mdl=auth&&ctrl=login&&msg=error');
            endif;
        else:
            header('Location:index.php?mdl=auth&&ctrl=login&&msg=error');
        endif;
    endif;
?>
<div class="account-pages mt-5 mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <!-- Logo -->
                    <div class="card-header text-center bg-primary">
                        <a href="#">
                            <span><img src="<?= LOGIN_ICON ?>logo.png" alt="app logo" height="70"></span>
                        </a>
                        <p class="mb-2" style="font-weight: bold;color: #000;text-transform: uppercase;">Ministère de l'Enseignement Superieur</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Authentification</h4>
                            <p class="text-muted mb-4">Entrez votre nom d'utilisateur et votre mot de passe pour accéder à votre espace de travail.</p>
                        </div>
                        <form method="POST" action="" role="form">
                            <div class="form-group">
                                <label for="userid">Nom d'utilisateur</label>
                                <input class="form-control" type="text" name="userid" required placeholder="Nom d'utilisateur...">
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input class="form-control" type="password" required name="password" placeholder="Mot de passe...">
                            </div>
                            <div class="form-group mb-0 text-center">
                                <input type="submit" name="submit" value="Se connecter" class="btn btn-primary" />
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
<!-- end page -->
<footer class="footer footer-alt">
    2022 - <?= date('Y') ?> © Ministère de l'Enseignement Superieur
</footer>