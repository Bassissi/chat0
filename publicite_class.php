<?php

class Publicite
{
    // propriété 
	protected $idPublicite; 

  /**
  * 
  * constructeur 
  * @param string $type
  * @return void
  */
	public function __construct($idPublicite)
	{
		$this->idPublicite=$idPublicite; 
	}


  /**-1-
  * 
  * chercherPublicité 
  * @param   
  * @return  string array 
  */
  	public function chercherUne()
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("SELECT * FROM `publicite` WHERE id='$this->idPublicite'");
	  	$requette->execute(array()); 

	  	$resultat=$requette->FetchAll(PDO::FETCH_ASSOC); 
	  	return $resultat; 
	  }  

	

  /**-2-
  * 
  * modifier une annonce 
  * @param  string $lien, string $url
  * @return  void
  */
  	public function modifierPublicite($lien, $url)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("UPDATE `publicite` SET `lien` = '$lien',`url` = '$url',`modification` =NOW() WHERE `publicite`.`id` = '$this->idPublicite' ");
	  	$resultat=$requette->execute(array());    
      
	  }  

 
}

?>