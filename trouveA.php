<?php
session_start(); 
include 'config/config.php'; 
include 'annonce_class.php';

 
if($_SESSION['connected']==true)
	{	
		/* instanciation un  objet pour chercher les annonces trouvés*/
	   $annonceT=new Annonce('trouve');
	       if ($annonceT->chercherAnnonces()!==null)
			  $annonceTs=$annonceT->chercherAnnonces();

		// le template
		$template='trouveA.phtml'; 
		include 'admin.phtml'; 
	

	}
	else
	{
	
       header("location:login.php"); 
	}

?>