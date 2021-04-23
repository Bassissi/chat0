<?php
session_start(); 
include 'config/config.php'; 
include 'annonce_class.php';

 
if($_SESSION['connected']==true)
	{	
		/* instanciation un  objet pour chercher les annonces retrouvées*/
  $annonceRT=new Annonce('retrouve');
	   if ($annonceRT->chercherAnnonces()!==null)
			    $annonceRTs=$annonceRT->chercherAnnonces();


		// le template
		$template='retrouveA.phtml'; 
		include 'admin.phtml'; 
		 

	}
	else
	{
	
       header("location:login.php"); 
	}

?>