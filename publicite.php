<?php
$id=$_GET['id']; 
include 'config/config.php'; 
include 'publicite_class.php';

session_start(); 
	if($id==1 && $_SESSION['connected']==true)
	{
         $publicite=new Publicite($id);
         $publiciteDetail=$publicite->chercherUne();
         $erreur=array();
         
         // mes conditions 
        if ( isset($_POST['changer']) && $_POST['vide']=='Non') 
        {
         // verfier du chargement
        	 $extention= strrchr($_FILES['uplaodI']['name'],'.');

		    if($extention!='.mp4'& $_FILES['uplaodI']['size']>1)
		    	$erreur[0]="Il faut que le fichier soit vidéo de type 'mp4'!"; 
	 		  if($_FILES['uplaodI']['size']>2500000)
		    	$erreur[1]="Votre fichier est très lourd, il est plus de 2,5 Mo"; 	    
        if (empty($_POST['lien'])==false && $_POST['lien']!=='null' && !preg_match("#http#", $_POST['lien']))   
           $erreur[2]="Il faut que le lien commence par https://www. ou http://www."; 

        if ($_FILES['uplaodI']['size']==0 && $publiciteDetail[0]['lien']==$_POST['lien'])   
           $erreur[2]="Vous n'avez rien changé !"; 

        }

        if ( isset($_POST['changer']) && $_POST['vide']=='Oui') 
        {
             // modifier les valeurs et les mettre vide "null"
            $publicite->modifierPublicite('null','null');
           $_SESSION['bien']="vous avez bien mis votre publicité vide.";
           $publicite1=new Publicite($id);
           $publiciteDetail1=$publicite1->chercherUne();

        }

       if( isset($_POST['changer']) && $erreur==null && $_POST['vide']=='Non')
       {
          // prendre les données que l'admin indique 

        // url de vidéo 
                if($_FILES['uplaodI']['size']>1)
                {

                 $nomDossier='publicite/'.$publiciteDetail[0]['modification'].'.mp4'; 
                 move_uploaded_file($_FILES['uplaodI']['tmp_name'], $nomDossier); 
                 $url=$nomDossier; 
                 }
                 else
                 {
                  $url=$publiciteDetail[0]['url']; 
                 }
                
       // le lien 
               $lien=$_POST['lien']; 

       // modifier 
           $publicite->modifierPublicite($lien,$url);
           $_SESSION['bien']="vous avez bien modifié votre publicité.";  
           $publicite1=new Publicite($id);
           $publiciteDetail1=$publicite1->chercherUne();       


       }

         //include mon formulaire
          $template='modifierPublicite.phtml';
	      include "admin.phtml"; 
		
	}
	if ($id==1 && $_SESSION['connected']==false)
	{
		 header("location:login.php"); 
	}

     // pour la publicité 2 et la publicité 3 et la publicité 4

if(in_array($id,[2,3,4]) && $_SESSION['connected']==true)
  {
         $publicite=new Publicite($id);
         $publiciteDetail=$publicite->chercherUne();
         $erreur=array();
         
         // mes conditions 
        if ( isset($_POST['changer']) && $_POST['vide']=='Non') 
        {
         // verfier du chargement
           $extention= strrchr($_FILES['uplaodI']['name'],'.');

        if( !in_array($extention, ['.jpg','.png','.gif'])& $_FILES['uplaodI']['size']>1)
          $erreur[0]="Il faut que le fichier soit photo !"; 
        if($_FILES['uplaodI']['size']>1500000)
          $erreur[1]="Votre fichier est très lourd, il est plus de 1,5 Mo";       
        if (empty($_POST['lien'])==false && $_POST['lien']!=='null' && !preg_match("#http#", $_POST['lien']))   
           $erreur[2]="Il faut que le lien commence par https://www. ou http://www."; 

        if ($_FILES['uplaodI']['size']==0 && $publiciteDetail[0]['lien']==$_POST['lien'])   
           $erreur[2]="Vous n'avez rien changé !"; 

        }

        if ( isset($_POST['changer']) && $_POST['vide']=='Oui') 
        {
             // modifier les valeurs et les mettre vide "null"
            $publicite->modifierPublicite('null','null');
           $_SESSION['bien']="vous avez bien mis votre publicité vide.";
           $publicite1=new Publicite($id);
           $publiciteDetail1=$publicite1->chercherUne();

        }

       if( isset($_POST['changer']) && $erreur==null && $_POST['vide']=='Non')
       {
          // prendre les données que l'admin indique 

        // url de vidéo 
                if($_FILES['uplaodI']['size']>1)
                {

                 $nomDossier='publicite/'.$publiciteDetail[0]['modification']; 
                 move_uploaded_file($_FILES['uplaodI']['tmp_name'], $nomDossier); 
                 $url=$nomDossier; 
                 }
                 else
                 {
                  $url=$publiciteDetail[0]['url']; 
                 }
                
       // le lien 
               $lien=$_POST['lien']; 

       // modifier 
           $publicite->modifierPublicite($lien,$url);
           $_SESSION['bien']="vous avez bien modifié votre publicité.";  
           $publicite1=new Publicite($id);
           $publiciteDetail1=$publicite1->chercherUne();       


       }

         //include mon formulaire
          $template='modifierPublicite.phtml';
        include "admin.phtml"; 
    
  }
  if (in_array($id,[2,3,4]) && $_SESSION['connected']==false)
  {
     header("location:login.php"); 
  }



?>