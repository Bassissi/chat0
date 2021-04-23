<?php
include 'config/config.php'; 
include 'annonce_class.php';
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(2);
$publiciteDetail=$publicite->chercherUne();
$idchat=$_GET['idchat']; 
$type=$_GET['type']; 
$location='Location:'.$type.'s.php'; 
session_start(); 

$annonce=new Annonce($type); 
$annonceDetail=$annonce->chercherUne($idchat);




if (isset($_POST['submit'] ) && $type=='perdu')
	{
		
	    $erreur=array();  

        // verifier le numéro de téléphone
        if($annonceDetail[0]['phone']!=$_POST['phone'])
	        {
	        // vérifier si le client a déjà publié une annonce ou pas
	        $annonce1=new Annonce('perdu'); 
	        $verifierphone=$annonce1->verifierPhone($_POST['phone']);
	        if($verifierphone)
	        	$erreur[0]="Vous avez déjà publié une annonce ! Vous ne pouvez pas publier un autre annonce !";

	        $annonce12=new Annonce('trouve'); 
	        $verifierphone2=$annonce12->verifierPhone($_POST['phone']);
	        if($verifierphone2)
	        	$erreur[0]="Vous avez déjà publié une annonce ! Vous ne pouvez pas publier un autre annonce !";  

	        }

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
				$erreur[8]="Les caractères particuliers ne doivent pas contenir le symbole <";
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
				$erreur[13]=" La rue ne doit pas contenir le symbole <";

            // vérifier si l'utilisateur met le même nom toujours                
 
	        if($_FILES['uplaodI']['name']!=null)
		          { 

                    if($annonceDetail[0]['phone']==$_POST['phone'])
                    {
                    	$nomDossierN='img/'.$_POST['phone'].$_FILES['uplaodI']['name']; 
                        $annonce3=new Annonce($type); 
                        $verifierURL=$annonce3->verifierURL($nomDossierN); 
                       // var_dump($nomDossierN); 
                        //var_dump($verifierURL); 
                        if($verifierURL)
                        	$erreur[14]= "changez le nom du fichier 'photo' que vous voulez téléchargé SVP.";                	
                    }
                 }
           


	       if($erreur==null)
	       {    
	       	     // enregistrer l'image 
	             $nomDossier='img/'.$_POST['phone']; 
	          if($_FILES['uplaodI']['name']!=null)
		          { 

                    if($annonceDetail[0]['phone']==$_POST['phone'])
                    {
                    	$nomDossierN='img/'.$_POST['phone'].$_FILES['uplaodI']['name']; 

					 move_uploaded_file($_FILES['uplaodI']['tmp_name'], $nomDossierN); 
					 $url=$nomDossierN;                     	
                    }

                    else
                    {
					 move_uploaded_file($_FILES['uplaodI']['tmp_name'], $nomDossier); 
					 $url=$nomDossier; 
					} 
	               }
	           else
	               $url=$annonceDetail[0]['url']; 
				  
	            /*
	            //autre façon pour modifier une annonce.
	            $annonce1=new Annonce('perdu'); 

				$annonce1->modifierAnnonceT($idchat,$_POST['nom'],$_POST['sex'],$url,$_POST['race'],$couleurs,$_POST['poils'],$_POST['pelage'],$_POST['castre'],$datePT,$_POST['rue'],$_POST['arrondissement'],$_POST['description'],$_POST['phone'],$dateNaissance);
             
		      */
                // instanciation un objet pour rajouter une annonce(modifier une annonce) 

		        $annonce2=new Annonce('perdu');
		        $annonce2->supprimerAnnonce($idchat); 
		        $annonce2->ecrireAnnonce($_POST['nom'],$_POST['sex'],$url,$_POST['race'],$couleurs,$_POST['poils'],$_POST['pelage'],$_POST['castre'],$datePT,$_POST['rue'],$_POST['arrondissement'],$_POST['description'],$_POST['phone'],$dateNaissance);

			  	$_SESSION['messageModifier']='Vous avez bien modifié votre annonce'; 
				header($location);
	       }


	$template='modifierperdu.phtml';
	include "layout.phtml"; 

	}
	if(!isset($_POST['submit'] ) && $type=='perdu')
	{
	$template='modifierperdu.phtml';
		include "layout.phtml";		
	}

if(isset($_POST['submit'] ) && $type=='trouve')
{
	
    $erreur=array();

           // verifier le numéro de téléphone
    if($annonceDetail[0]['phone']!=$_POST['phone'])
	        {
	        // vérifier si le client a déjà publié une annonce ou pas
	        $annonce1=new Annonce('trouve'); 
	        $verifierphone=$annonce1->verifierPhone($_POST['phone']);
	        if($verifierphone)
	        	$erreur[0]="Vous avez déjà publié une annonce ! Vous ne pouvez pas publier un autre annonce !"; 
	        
	        $annonce12=new Annonce('perdu'); 
	        $verifierphone2=$annonce12->verifierPhone($_POST['phone']);
	        if($verifierphone2)
	        	$erreur[0]="Vous avez déjà publié une annonce ! Vous ne pouvez pas publier un autre annonce !";    	   
   

	        }    


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
		$erreur[12]="La rue ne doit pas contenir le symbole <"; 

			         if($_FILES['uplaodI']['name']!=null)
		          { 

                    if($annonceDetail[0]['phone']==$_POST['phone'])
                    {
                    	$nomDossierN='img/'.$_POST['phone'].$_FILES['uplaodI']['name']; 
                        $annonce3=new Annonce($type); 
                        $verifierURL=$annonce3->verifierURL($nomDossierN); 
                       // var_dump($nomDossierN); 
                        //var_dump($verifierURL); 
                        if($verifierURL)
                        	$erreur[13]= "changez le nom du fichier 'photo' que vous avez téléchargé SVP.";                	
                    }
                 }
             



       if($erreur==null)
       {    
	       	     // enregistrer l'image 
               $nomDossier='img/'.$_POST['phone']; 
	          if($_FILES['uplaodI']['name']!=null)
		          { 

                    if($annonceDetail[0]['phone']==$_POST['phone'])
                    {
                    	$nomDossierN='img/'.$_POST['phone'].$_FILES['uplaodI']['name']; 

					 move_uploaded_file($_FILES['uplaodI']['tmp_name'], $nomDossierN); 
					 $url=$nomDossierN;                     	
                    }

                    else
                    {
					 move_uploaded_file($_FILES['uplaodI']['tmp_name'], $nomDossier); 
					 $url=$nomDossier; 
					} 
	               }
	           else
	               $url=$annonceDetail[0]['url']; 
			 // instanciation un objet pour ajouter une annonce 
             
             $annonce2=new Annonce('trouve');
			   if($_POST['nom']==null)
			        $nom=$annonceDetail[0]['name'];
			   else
			       $nom=$_POST['nom'];

			   //autre façon pour modifier une annonce.
               /*
			  	$annonce1->modifierAnnonceT($idchat,$nom,$_POST['sex'],$url,$_POST['race'],$couleurs,$_POST['poils'],$_POST['pelage'],$_POST['castre'],$datePT,$_POST['rue'],$_POST['arrondissement'],$_POST['description'],$_POST['phone'],$dateNaissance);
             
               */
			  	 // instanciation un objet pour rajouter une annonce(modifier une annonce) 

		        
		        $annonce2->supprimerAnnonce($idchat); 
		        $annonce2->ecrireAnnonce($nom,$_POST['sex'],$url,$_POST['race'],$couleurs,$_POST['poils'],$_POST['pelage'],$_POST['castre'],$datePT,$_POST['rue'],$_POST['arrondissement'],$_POST['description'],$_POST['phone'],$dateNaissance);

		  	$_SESSION['messageModifier']='Vous avez bien modifié votre annonce'; 
		   header($location);
       }


	$template='modifiertrouve.phtml';
	include "layout.phtml";

}
if(!isset($_POST['submit'] ) && $type=='trouve')
{
	$template='modifiertrouve.phtml';
	include "layout.phtml";
}





?>