<?php

include 'config/config.php'; 
include 'annonce_class.php';
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(4);
$publiciteDetail=$publicite->chercherUne();

$idchat=$_GET['idchat']; 
$type=$_GET['type']; 
$location='Location:modifierPT.php?idchat='.$idchat.'&type='.$type; 

/* instanciation un  objet  pour  supprimer cette annonce */
$annonce0=new Annonce($type);

	if(isset($_POST['modifier']))
	{
		 
		$dateNaissance=date("d/m/Y", strtotime($_POST['dateNaissance']));	

		$existe=$annonce0->verifierIdDateNaissance($idchat,$dateNaissance); 

        if($existe)
        	header($location); 
        else 
        {
	         $messageE='Vérifiez de votre date de naissance !';
	         $template='modifier.phtml';
	         include 'layout.phtml';
        }

    }
    else
    {
	    	 $template='modifier.phtml';
	    	 if($type=='trouve')
    			$type='trouvé'; 
    		$templateTitle='modifier une annonce chat '.$type; 
	    	$templateDescription='dans cette partie on peut modifier une annonce chat '.$type." facilement par la date de naissance de l'utilisateur";
	    	$templateKeywords='modifier, annonce, chat, '.$type; 
	         include 'layout.phtml';    	
    }


?>