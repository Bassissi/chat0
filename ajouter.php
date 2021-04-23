<?php
$type=$_GET['type']; 
include 'config/config.php'; 
include 'annonce_class.php';
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(2);
$publiciteDetail=$publicite->chercherUne();

$location='Location:'.$type.'s.php';
session_start(); 


	if(isset($_POST['submit'] ) && $type=='perdu')
	{
		
	    $erreur=array();  


        // vérifier si le client a déjà publié une annonce ou pas
        $annonce=new Annonce('perdu'); 
        $verifierphone=$annonce->verifierPhone($_POST['phone']);
        if($verifierphone)
        	$erreur[0]="Vous avez déjà publié une annonce ! Vous ne pouvez pas publier un autre annonce !";

        $annonce12=new Annonce('trouve'); 
        $verifierphone2=$annonce12->verifierPhone($_POST['phone']);
        if($verifierphone2)
        	$erreur[0]="Vous avez déjà publié une annonce ! Vous ne pouvez pas publier un autre annonce !";    	   


	    // vérifier de non si vide 
	    if(empty($_POST['nom'])==true)
	    	$erreur[1]="Vous n'avez pas indiqué le nom de votre chat !"; 
		// pour chercher les couleur de lu formulaire.	
		$couleurs='';  
		for($i=1;$i<8;$i++)
		{    
			if( empty($_POST['c'.$i])==false)
				{
			
						$couleurs.=$_POST['c'.$i].' '; 
						
			    }
		}
	    if($couleurs=='')
	    	$erreur[14]= "Vous n'avez pas indiqué la couleur de votre chat !";
	    // vérifier de l'image 
	       $extention= strrchr($_FILES['uplaodI']['name'],'.');

		    if($extention!='.jpg'& $extention!='.gif' & $extention!='.png'& $_FILES['uplaodI']['size']>1)
		    	$erreur[2]="Vous avez téléchargé un fichier qui n'est pas photo !"; 
	 		if($_FILES['uplaodI']['size']>1500000)
		    	$erreur[3]="Votre fichier est très lourd, il est plus de 1,5 Mo"; 	    
			    	

	     // vérifier de date pedru ou date trouvé 
		    if($_POST['anPT']==date('Y') & $_POST['moisPT']>date('m') & $_POST['jourPT']>date('d') )
		    	$erreur[4]="Vérifiez de la date de disparition !";
		    if($_POST['anPT']==date('Y') & $_POST['moisPT']>date('m') & $_POST['jourPT']<=date('d') )
		    	$erreur[5]="Vérifiez de la date de disparition !"; 


		    else $datePT=$_POST['jourPT'].'/'.$_POST['moisPT'].'/'.$_POST['anPT']; 
		    if(( $_POST['moisPT']=='04' | $_POST['moisPT']=='06' | $_POST['moisPT']=='09' | $_POST['moisPT']=='11') & $_POST['jourPT']=='31')
                $erreur[6]="Vérifiez le jour de la disparition  parce que le mois que vous avez choisi est seulement 30 jours!";
            if ($_POST['moisPT']=='02' & ($_POST['jourPT']=='30' | $_POST['jourPT']=='31' ))
            	 $erreur[7]="Vérifiez le jour de la disparition  parce que le février est seulement 28-29 jours!";

			// vérifier le text de description 
			$description=$_POST['description']; 
			if (preg_match("#<#", $description))
				$erreur[8]="les caractères particuliers ne doivent pas contenir le symbole <";
			// vérifier de la rue 
		    if(empty($_POST['rue'])==true)
		    	$erreur[9]= "Vous n'avez pas indiqué le nom de la rue !";		
	   		// vérifier du numéro de téléphone 
	        if(empty($_POST['phone'])==true)
		    	$erreur[10]= "Vous n'avez pas indiqué votre numéro de téléphone !";

		    $dateNaissance=$_POST['jour'].'/'.$_POST['mois'].'/'.$_POST['an'];
		    if(( $_POST['mois']=='04' | $_POST['mois']=='06' | $_POST['moisPT']=='09' | $_POST['mois']=='11') & $_POST['jour']=='31')
                $erreur[11]="Vérifiez le jour de votre naissance parce que le mois que vous avez choisi est seulement 30 jours!";
            if ($_POST['mois']=='02' & ($_POST['jour']=='30' | $_POST['jour']=='31' ))
            	 $erreur[12]="Vérifiez le jour de votre naissance parce que le février est seulement 28-29 jours!";	

            	$rue=$_POST['rue']; 
			if (preg_match("#<#", $rue))
				$erreur[13]="la rue ne doit pas contenir le symbole <";            	 	     	


	       if($erreur==null)
	       {    
	       	     // enregistrer l'image 
	             $nomDossier='img/'.$_POST['phone']; 
				 move_uploaded_file($_FILES['uplaodI']['tmp_name'], $nomDossier); 
				 $url=$nomDossier; 
				 if($_FILES['uplaodI']['name']==null)
				 	$url='img/parDefaut.jpg';				 

				 // instanciation un objet pour ajouter une annonce 
	             
	             $annonce=new Annonce('perdu');
			  	$annonce->ecrireAnnonce($_POST['nom'],$_POST['sex'],$url,$_POST['race'],$couleurs,$_POST['poils'],$_POST['pelage'],$_POST['castre'],$datePT,$_POST['rue'],$_POST['arrondissement'],$description,$_POST['phone'],$dateNaissance);

			  	$_SESSION['messageAjouter']='Vous avez bien ajouté votre annonce'; 
			  	header($location);
	       }


	$template='ajouterPerdu.phtml';

	include "layout.phtml"; 

	}
	if(!isset($_POST['submit'] ) && $type=='perdu')
	{
		$template='ajouterPerdu.phtml';
		$templateTitle='ajouter une annonce chat perdu'; 
	    $templateDescription='dans cette partie on peut ajouter une annonce chat perdu';
	    $templateKeywords='ajouter, annonce, chat, perdu, Marseille'; 
		include "layout.phtml";		
	}

if(isset($_POST['submit'] ) && $type=='trouve')
{
	
    $erreur=array();    

        $annonce=new Annonce('trouve'); 
        $verifierphone=$annonce->verifierPhone($_POST['phone']);
        if($verifierphone)
        	$erreur[0]="Vous avez déjà publié une annonce ! Vous ne pouvez pas publier un autre annonce !";

        $annonce12=new Annonce('perdu'); 
        $verifierphone2=$annonce12->verifierPhone($_POST['phone']);
        if($verifierphone2)
        	$erreur[0]="vous avez déjà publié une annonce ! Vous ne pouvez pas publier un autre annonce !";    	   
   
	// pour chercher les couleur de lu formulaire.	
	$couleurs='';  
	for($i=1;$i<8;$i++)
	{    
		if( empty($_POST['c'.$i])==false)
			{
		
					$couleurs.=$_POST['c'.$i].' '; 
					
		    }
	}
    if($couleurs=='')
    	$erreur[13]= "Vous n'avez pas indiqué la couleur de ce chat !";
    // vérifier de l'image 
       $extention= strrchr($_FILES['uplaodI']['name'],'.');

	    if($extention!='.jpg'& $extention!='.gif' & $extention!='.png'& $_FILES['uplaodI']['size']>1)
	    	$erreur[1]="Vous avez téléchargé un fichier qui n'est pas photo !"; 
 		if($_FILES['uplaodI']['size']>1500000)
	    	$erreur[2]="Votre fichier est très lourd, il est plus de 1,5 Mo"; 	    
		    	

     // vérifier de date pedru ou date trouvé 
	    if($_POST['anPT']==date('Y') & $_POST['moisPT']>date('m') & $_POST['jourPT']>date('d') )
	    	$erreur[3]="Vérifiez de la date où vous avez trouvé ce chat !";
	    if($_POST['anPT']==date('Y') & $_POST['moisPT']>date('m') & $_POST['jourPT']<=date('d') )
	    	$erreur[4]="Vérifiez de la date où vous avez trouvé ce chat !"; 	
	    else $datePT=$_POST['jourPT'].'/'.$_POST['moisPT'].'/'.$_POST['anPT'];

		if(( $_POST['moisPT']=='04' | $_POST['moisPT']=='06' | $_POST['moisPT']=='09' | $_POST['moisPT']=='11') & $_POST['jourPT']=='31')
            $erreur[5]="Vérifiez le jour où vous l'avez trouvé  parce que le mois que vous avez choisi est seulement 30 jours!";
        if ($_POST['moisPT']=='02' & ($_POST['jourPT']=='30' | $_POST['jourPT']=='31' ))
             $erreur[6]="Vérifiez le jour où vous l'avez trouvé  parce que le février est seulement 28-29 jours!";

		// vérifier le text de description 
		$description=$_POST['description']; 
		if (preg_match("#<#", $description))
			$erreur[7]="Les caractères particuliers ne doivent pas contenir le symbole <";
		// vérifier de la rue 
	    if(empty($_POST['rue'])==true)
	    	$erreur[8]= "Vous n'avez pas indiqué le nom de la rue !";		
   		// vérifier du numéro de téléphone 
        if(empty($_POST['phone'])==true)
	    	$erreur[9]= "Vous n'avez pas indiqué votre numéro de téléphone !";

	    $dateNaissance=$_POST['jour'].'/'.$_POST['mois'].'/'.$_POST['an'];
		if(( $_POST['mois']=='04' | $_POST['mois']=='06' | $_POST['moisPT']=='09' | $_POST['mois']=='11') & $_POST['jour']=='31')
            $erreur[10]="Vérifiez le jour de votre naissance parce que le mois que vous avez choisi est seulement 30 jours !";
        if ($_POST['mois']=='02' & ($_POST['jour']=='30' | $_POST['jour']=='31' ))
            $erreur[11]="Vérifiez le jour de votre naissance parce que le février est seulement 28-29 jours!";

        $rue=$_POST['rue']; 
		if (preg_match("#<#", $rue))
			$erreur[12]="la rue ne doit pas contenir le symbole <";            		     	


       if($erreur==null)
       {    
       	     // enregistrer l'image 
	             $nomDossier='img/'.$_POST['phone']; 
				 move_uploaded_file($_FILES['uplaodI']['tmp_name'], $nomDossier); 
				 $url=$nomDossier; 
				 if($_FILES['uplaodI']['name']==null)
				 	$url='img/parDefaut.jpg';
			 // instanciation un objet pour ajouter une annonce 
             
             $annonce=new Annonce('trouve');
			   if($_POST['nom']!=null)
			        $nom=$_POST['nom'];
			   else
			       $nom='chat par défaut';
					  	$annonce->ecrireAnnonce($nom,$_POST['sex'],$url,$_POST['race'],$couleurs,$_POST['poils'],$_POST['pelage'],$_POST['castre'],$datePT,$_POST['rue'],$_POST['arrondissement'],$description,$_POST['phone'],$dateNaissance);
			    if($_POST['nom']==null)
			            {
						$annonces=$annonce->chercherAnnonces();
						foreach ($annonces as $key=> $value)
					        {
						  		if($key==0)
						  		$idchat=$value['idchat']; 
						  	} 
			            
			            $nomP='Chat'.$idchat;             
					  	$annonce->modifierPourNom($idchat,$nomP); 
					    }

		  	$_SESSION['messageAjouter']='Vous avez bien ajouté votre annonce'; 
		  	header($location);
       }


	$template='ajouterTrouve.phtml';
	include "layout.phtml";

}
if(!isset($_POST['submit'] ) && $type=='trouve')
{
	$template='ajouterTrouve.phtml';
	$templateTitle='ajouter une annonce chat trouvé'; 
	$templateDescription='dans cette partie on peut ajouter une annonce chat trouvé';
	$templateKeywords='ajouter, annonce, chat, trouvé, Marseille'; 
	include "layout.phtml";
}




?>