<?php

include 'config/config.php'; 
include 'annonce_class.php';
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(4);
$publiciteDetail=$publicite->chercherUne();

$idchat=$_GET['idchat'];  
$messageS=$_GET['messageS']; 
$type=$_GET['type']; 
session_start();
$location='Location:'.$type.'s.php'; 

/* instanciation un  objet  pour  supprimer cette annonce */
$annonce=new Annonce($type);

	if(isset($_POST['supprimer']))
	{
		 
		$dateNaissance=date("d/m/Y", strtotime($_POST['dateNaissance'])); 
		
	

		$existe=$annonce->verifierIdDateNaissance($idchat,$dateNaissance); 
     
		if($_POST['messageR']=='Non' & $existe==true )
		{
          $annonce->supprimerAnnonce($idchat); 
          $_SESSION['messageSCI']='Vous avez bien supprimé votre annonce.';
          header($location);  
		}

		if($_POST['messageR']=='Oui' & $existe==true )
		{
          $annonce->modifierAnnonce($idchat); 
          $_SESSION['messageSCI']='Vous avez bien supprimé votre annonce.';
          header($location);  
		}
		
		if($_POST['messageR']=='Oui' & $existe==false )
		{
          
          $messageSCS='Vérifiez de votre date de naissance !';
         $template='supprimer.phtml';
         include 'layout.phtml';
           
		}

		if($_POST['messageR']=='Non' & $existe==false )
		{
          
          $messageSCS='Vérifiez de votre date de naissance !';
         $template='supprimer.phtml';
         include 'layout.phtml';
           
		}

	}
    
    else
    {
    	$template='supprimer.phtml'; 
    	if($type=='trouve')
    		$type='trouvé'; 
    	$templateTitle='supprimer une annonce chat '.$type; 
	    $templateDescription='dans cette partie on peut supprimer une annonce chat '.$type." facilement par la date de naissance de l'utilisateur";
	    $templateKeywords='supprimer, annonce, chat, '.$type; 
    	include 'layout.phtml';
    }


 

?>