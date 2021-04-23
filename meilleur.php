<?php
include 'config/config.php'; 
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(3);
$publiciteDetail=$publicite->chercherUne();

$template='meilleur.html'; 
$templateTitle='Le meilleur site de publier des annonces chats perdus ou trouvés a Marseille'; 
$templateDescription='ce site est le meilleurs parmi des sites de publier des annonces chats perdus ou trouvés à Marseille'; 
$templateKeywords='meilleur, site, publier, chat, perdu, trouve, marseille, france';  
include 'layout.phtml'; 


?>