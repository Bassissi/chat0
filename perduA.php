<?php
session_start(); 
include 'config/config.php'; 
include 'annonce_class.php';

 
if($_SESSION['connected']==true)
	{	
		/* instanciation un  objet pour chercher les annonces perdues*/
		$annonceP=new Annonce('perdu');
			if ($annonceP->chercherAnnonces()!==null)
					$annoncePs=$annonceP->chercherAnnonces();

		// le template
		$template='perduA.phtml'; 
		include 'admin.phtml'; 
	

	}
	else
	{
	
       header("location:login.php"); 
	}

?>