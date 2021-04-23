<?php
include 'config/config.php'; 
include 'Admin_class.php';
session_start();
$_SESSION['connected']=false; 
 
if(isset($_POST['submit']))
	{
		 $erreur=array();

		// vérifier d'identifiant si vide 
	    if(empty($_POST['id'])==true)
	    	$erreur[0]="Vous n'avez pas indiqué votre identifiant !";

		// vérifier du mot de passe si vide 
	    if(empty($_POST['password'])==true)
	    	$erreur[1]="Vous n'avez pas indiqué votre mot de passe !";

        if (preg_match("#<#", $_POST['id']))
				$erreur[2]="L'identifiant ne doit pas contenir le symbole <";

        if (preg_match("#<#", $_POST['password']))
				$erreur[3]="Le mot de passe ne doit pas contenir le symbole <";

		// vérifier l'identifiant et le mot de passe s'ils existent ou pas	
		$admin=new Admin(); 
		if ($admin->verifierNP($_POST['id'],$_POST['password'])==false)
			  $erreur[4]="Vérifiez votre saisie !";



	    if($erreur==null)
	       {    

				 // chercher détais du l'admin 
	             
	             $admin= new Admin(); 
			  	 $detailAdmin=$admin->chercherAdmin();	  	 
			  	 $_SESSION['connected']=true; 
			  	 $template='detailAdmin.phtml';
			  	 
	       }

           include "admin.phtml"; 

       
	}
 else
	 {
	 		$template='login.phtml';
			include "admin.phtml"; 
	 }





?>