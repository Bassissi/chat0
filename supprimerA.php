<?php

include 'config/config.php'; 
include 'annonce_class.php';
include 'Admin_class.php';


$idchat=$_GET['id'];  
 
$type=$_GET['type']; 
session_start();
$location='Location:'.$type.'A.php'; 

/* instanciation un  objet  pour  supprimer cette annonce */
$annonce=new Annonce($type);

	if($_SESSION['connected']=true )
	{ 
          $annonce->supprimerAnnonce($idchat); 
          $_SESSION['messageSA']='Vous avez bien supprimé cette annonce.';

          $_SESSION['connected']==true; 
          
	
          header($location); 
        
	}
    
    else
    {
  		header("location:login.php"); 
    }


 ?>


