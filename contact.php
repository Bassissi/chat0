<?php
include 'config/config.php'; 
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(3);
$publiciteDetail=$publicite->chercherUne();
$template='contact.html'; 
$templateTitle='Développeur Web junior à Marseille'; 
$templateDescription='les données de Hmzeh Bassissi développeur Web'; 
$templateKeywords='Hmzeh, Bassissi, développeur, Web, junior, Marseille, France'; 
include 'layout.phtml'; 

?>