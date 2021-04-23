<?php
include 'config/config.php'; 
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(3);
$publiciteDetail=$publicite->chercherUne();
$template='publier.phtml';
$templateTitle='des publications chats perdus chats trouvés à Marseille';
$templateDescription='dans cette partie on peut publier des annonces chats perdus chat trouvés à Marseille';   
$templateKeywords='annonces, publications, chat, perdu, trouvé, Marseille';   
include 'layout.phtml'; 


?>