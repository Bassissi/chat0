<?php
include 'config/config.php'; 
include 'Admin_class.php';

session_start();
$admin= new Admin();
 
if(isset($_POST['submit']) & $_SESSION['connected']==true)
	{
		 $erreur=array();

		// vérifier d'identifiant si vide 
	    if(empty($_POST['oldPassword'])==true)
	    	$erreur[0]="Vous n'avez pas indiqué votre ancien mot de passe !";

		// vérifier du mot de passe si vide 
	    if(empty($_POST['newPassword'])==true)
	    	$erreur[1]="Vous n'avez pas indiqué votre nouveau mot de passe !";

	    if($_POST['newPassword']!==$_POST['rNewPassword'])
	    	$erreur[2]="Votre répétition du nouveau mot de passe  n'est pas la même !";

        if (preg_match("#<#", $_POST['oldPassword']))
				$erreur[3]="votre ancien mot de passe ne doit pas contenir le symbole <";

        if (preg_match("#<#", $_POST['newPassword']))
				$erreur[4]="votre nouveau mot de passe  ne doit pas contenir le symbole <";
        if (preg_match("#<#", $_POST['rNewPassword']))
				$erreur[5]="Votre répétition du nouveau mot de passe ne doit pas contenir le symbole <";

		// vérifier l'identifiant et le mot de passe s'ils existent ou pas	
	if(empty($_POST['oldPassword'])==false)	
		if ($admin->verifierNP('*Admin***0782440117',$_POST['oldPassword'])==false)
			  $erreur[6]="Votre ancien mot de passe n'est pas correct !";


        
	    if($erreur==null)
	       {    

				 // ajouter le nouveau mot 
	             $changerMA=$admin->modifierM($_POST['newPassword']); 
	              

	             $_SESSION['messageCM']="Vous avez bien changé votre mot de passe !";   
			  	  
			  	
			  	 
	       }
	       $_SESSION['erreur']=$erreur; 

           $template='changerMA.phtml';
           include "admin.phtml"; 

       
	}
if(!isset($_POST['submit']) & $_SESSION['connected']==true) 	
{
    $template='changerMA.phtml';
      include "admin.phtml"; 
}

if($_SESSION['connected']==false)
	 {
		header("location:login.php"); 
	 }






?>