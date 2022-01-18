<?php
    class Connection 
    {
        private $nom_utilis_users;
        private $mdp;
        public function __construct( $nom_utilis_users, $mdp ) {$this->nom_utilis_users = $nom_utilis_users; $this->mdp = $mdp; }
	   	public function is_member() {
	        $model = new Model( PDO2::getInstance());
		   	$cpt = $model->countData(PREFIX.'users', ['fields'=>"COUNT(id_users)",'conditions'=>['login'=>$this->nom_utilis_users, 'mdp_users'=>$this->mdp]]);
		   	if($cpt == 1): return true;
			else: return false;
			endif;
	   	}
	   	public function is_navigator_valid() {
	        $navigator = new Util(); $nav = $navigator->getNavigator(); $nomnav = $nav['browser']; $vernav = (int) $nav['version'];
            if( ($vernav < 9 AND $nomnav == 'ie') || ($vernav < 10 AND $nomnav == 'firefox') || ($vernav < 10 AND $nomnav == 'opera') || ($vernav < 10 AND $nomnav == 'chrome')):
				return false;
            else:
			    return true;
			endif;
	    }
	   	public function disconnect() 
	   	{
           	$_SESSION[] = []; 
           	session_destroy(); 
           	unset($_SESSION);	
           	header('Location:index.php?mdl=auth&&ctrl=login');		   
	   	}
       	public function createSession() {
	      	$model = new Model( PDO2::getInstance());			   
		   	$user = $model->singleData(PREFIX.'users', ['conditions'=>['login'=>$this->nom_utilis_users]]);
		   	$_SESSION['nom_users'] = $user['nom_users'];
		   	$_SESSION['nom_utilis_users'] = $user['login'];
		   	$_SESSION['mdp_users'] = $user['mdp_users'];
		   	$_SESSION['id_users'] = $user['id_users'];
		   	$_SESSION['active'] = $user['active']; 
		   	$_SESSION['groupe'] = $user['groupe']; 
		   	$_SESSION['sexe'] = $user['sexe'];
		   	$_SESSION['adresse'] = $user['adresse'];
		}
        public function auth_passe() {
		    if( !$this->is_navigator_valid()): header('Location:../../../index.php?try=connect&&run=mc&&navbug'); 	       
		   	elseif(!$this->is_member()): return false; 
		   	else: $this->createSession(); return true; endif;	   
		}
	}