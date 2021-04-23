<?php
include 'config/config.php'; 
include 'annonce_class.php';
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(2);
$publiciteDetail=$publicite->chercherUne();

/* instanciation un  objet pour chercher les annonces de chats retrouvés*/
$annonceRT=new Annonce('retrouve');
	if ($annonceRT->chercherAnnonces()!==null)
			$annonceRTs=$annonceRT->chercherAnnonces();

// le template
$template='retrouves.phtml';
$templateTitle='chat retrouvé'; 
$templateDescription='Chats retrouvés à Marseille france'; 
$templateKeywords='chat, retrouvé, Marseille, France';  
include 'layout.phtml'; 


?>