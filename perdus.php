<?php
include 'config/config.php'; 
include 'annonce_class.php';
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(2);
$publiciteDetail=$publicite->chercherUne();
session_start(); 

/* instanciation un  objet pour chercher les annonces perdues*/
$annonceP=new Annonce('perdu');
	if ($annonceP->chercherAnnonces()!==null)
			$annoncePs=$annonceP->chercherAnnonces();

// le template
$template='perdus.phtml'; 
$templateTitle='chat perdu'; 
$templateDescription='Vous pouvez publier des annonces chats perdus marseille france'; 
$templateKeywords='chat, perdu,Marseille, France'; 
include 'layout.phtml'; 


?>