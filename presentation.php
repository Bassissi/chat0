<?php
include 'config/config.php'; 
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(3);
$publiciteDetail=$publicite->chercherUne();

$template='presentation.html'; 
include 'layout.phtml'; 


?>