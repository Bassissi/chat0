<?php
include 'config/config.php'; 
include 'annonce_class.php';
include 'publicite_class.php';
// pour la publicité
$publicite=new Publicite(3);
$publiciteDetail=$publicite->chercherUne();

$publicite1=new Publicite(2);
$publiciteDetail1=$publicite1->chercherUne();

/* instanciation trois objets pour chercher les annonces perdues,les annonces trouvées et les annonces retrouvées par arrondissement*/
$annonceP=new Annonce('perdu');
$annonceT=new Annonce('trouve');
$annonceRT=new Annonce('retrouve'); 

$templateTitle='rechercher votre chat Marseille'; 
$templateDescription="vous pouvez facilement rechercher votre chat à Marseille";
$templateKeywords="rechercher, chat, marseille, france";  
if(isset($_POST['chercher']))
	{
		if ($annonceP->chercherArrondissement($_POST['arrondissement'])!==null)
			{
					$annoncePs=$annonceP->chercherArrondissement($_POST['arrondissement']);
					$template='resultatArrondissement.phtml';

			}

		if ($annonceT->chercherArrondissement($_POST['arrondissement'])!==null)
			{
					$annonceTs=$annonceT->chercherArrondissement($_POST['arrondissement']);

					$template='resultatArrondissement.phtml';
			}
		
		if ($annonceRT->chercherArrondissement($_POST['arrondissement'])!==null)
			{
		      	    $annonceRTs=$annonceRT->chercherArrondissement($_POST['arrondissement']);
		      	    $template='resultatArrondissement.phtml';
			}

	    if ($annonceP->chercherArrondissement($_POST['arrondissement'])==null && $annonceT->chercherArrondissement($_POST['arrondissement'])==null && $annonceRT->chercherArrondissement($_POST['arrondissement'])==null ) 
	    		{
	    			$messageR='Aucun résultat,vous pouvez lanser dans un autre arrondissement';
	    			$template='rechercher.phtml';

	    		}

	    


	    include 'layout.phtml';  	 
	}

else
	{
		$template='rechercher.phtml'; 
		include 'layout.phtml'; 

	}	

?>