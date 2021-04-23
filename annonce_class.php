<?php

class Annonce
{
    // propriété 
	protected $type; 

  /**
  * 
  * constructeur 
  * @param string $type
  * @return void
  */
	public function __construct($type)
	{
		$this->type=$type; 
	}

  /********************Mes méthodes*****************************/  
  /**-1-
  * 
  * chercherAnnonces 
  * @param  void
  * @return  string array 
  */
  	public function chercherAnnonces()
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("SELECT * FROM `chat` WHERE type='$this->type' order by dateAnnonce desc");
	  	$requette->execute(array()); 

	  	$resultat=$requette->FetchAll(PDO::FETCH_ASSOC); 
	  	return $resultat; 
	  }

  /**-2-
  * 
  * chercherArrondissement 
  * @param  string $idchat  $dateNaissance
  * @return  string array 
  */
  	public function chercherUne($idchat)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("SELECT * FROM `chat` WHERE type='$this->type'and idchat='$idchat'  ");
	  	$requette->execute(array()); 

	  	$resultat=$requette->FetchAll(PDO::FETCH_ASSOC); 
	  	return $resultat; 
	  }  


  /**-3-
  * 
  * chercherArrondissement 
  * @param  string $arrondissement
  * @return  string array 
  */
  	public function chercherArrondissement($arrondissement)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("SELECT * FROM `chat` WHERE type='$this->type'and arrondissement=$arrondissement order by dateAnnonce desc");
	  	$requette->execute(array()); 

	  	$resultat=$requette->FetchAll(PDO::FETCH_ASSOC); 
	  	return $resultat; 
	  }  

  /**-4-
  * 
  * Vérifier le numéro de téléphone si il existe ou pas 
  * @param  int $phone
  * @return  bool 
  */
  	public function verifierPhone($phone)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("SELECT * FROM `chat` WHERE type='$this->type'and phone=$phone order by dateAnnonce desc");
	  	$requette->execute(array()); 

	  	$resultat=$requette->FetchAll(PDO::FETCH_ASSOC); 
	  	
        if(empty($resultat))
        	return false; 
        else
        	return true; 
      
	  }  

  /**-5-
  * 
  * Vérifier la dateNaissance et idcht  si ils existent ou pas 
  * @param  int $idchat et $dateNaissance
  * @return  bool 
  */
  	public function verifierIdDateNaissance($idchat,$dateNaissance)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("SELECT * FROM `chat` WHERE type='$this->type'and idchat='$idchat' and dateNaissance='$dateNaissance' ");
	  	$requette->execute(array()); 

	  	$resultat=$requette->FetchAll(PDO::FETCH_ASSOC); 
	  	
        if(empty($resultat))
        	return false; 
        else
        	return true; 
      
	  }  



  /**-6-
  * 
  * ecrire : écrire une annonce dans notre tableau sql 
  * @param  tous les paramètres 
  * @return  void
  */
  	public function ecrireAnnonce($name,$sex,$url,$race,$couleurs,$poils,$pelage,$castre,$datePT,$rue,$arrondissement,$description,$phone,$dateNaissance)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare('INSERT INTO `chat` (`idchat`, `type`, `name`, `sex`, `url`, `race`, `couleurs`, `poils`, `pelage`, `castre`, `dateAnnonce`, `datePT`, `rue`, `arrondissement`, `description`, `phone`, `dateNaissance`) VALUES (NULL,?,?,?,?,?,?,?,?,?,NOW(),?,?,?,?,?,?);');
	  	//$moment=NOW(); 
	  	$requette->execute(array($this->type, $name, $sex, $url, $race, $couleurs, $poils, $pelage, $castre,$datePT , $rue, $arrondissement, $description, $phone,$dateNaissance )); 

	  }  



  /**-7-
  * 
  * supprimer une annonce 
  * @param  int $idchat
  * @return  void 
  */
  	public function supprimerAnnonce($idchat)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("DELETE FROM `chat` WHERE `chat`.`idchat` ='$idchat' and type='$this->type' ");
	  	$resultat=$requette->execute(array());    
      
	  }  

  /**-8-
  * 
  * modifier une annonce 
  * @param  int $idchat
  * @return  void
  */
  	public function modifierAnnonce($idchat)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("UPDATE `chat` SET `type` = 'retrouve',`dateModifier` =NOW() WHERE `chat`.`idchat` = '$idchat' ");
	  	$resultat=$requette->execute(array());    
      
	  }  

  /**-9-
  * 
  * modifier pour avoir un nom de chat trouvé a partire de idchat 
  * @param  int $idchat et string $nom
  * @return  void
  */
  	public function modifierPourNom($idchat,$nom)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("UPDATE `chat` SET `name`='$nom' WHERE `chat`.`idchat` = '$idchat' ");
	  	$resultat=$requette->execute(array());    
      
	  }  
  /**-10-
  * modifier tous dans une annonce 
  *@param  int $idchat et string $nom, $sex, $url,$race, $couleurs,$poils, $pelage, $castre, $dateAnnonce, $datePt, $rue, $arrondissement,$description,$phone,$dateNaissance   
  * @return  void
  *
  */
  	public function modifierAnnonceT($idchat,$nom,$sex,$url,$race,$couleurs,$poils,$pelage,$castre,$datePT,$rue,$arrondissement,$description,$phone,$dateNaissance)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("UPDATE `chat` SET `type` ='$this->type',name='$nom',sex='$sex',url='$url',race='$race',couleurs='$couleurs',poils='$poils',pelage='$pelage',castre='$castre',`dateAnnonce` =NOW(),datePT='$datePT',rue='$rue',arrondissement='$arrondissement', description='$description', phone='$phone',dateNaissance='$dateNaissance' WHERE `chat`.`idchat` = '$idchat' ");
	  	$resultat=$requette->execute(array()); 
	  	   
      
	  }  

  /**-11-
  * 
  * Vérifier le url si il existe ou pas 
  * @param  int $url
  * @return  bool 
  */
  	public function verifierURL($url)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("SELECT * FROM `chat` WHERE type='$this->type'and url='$url' ");
	  	$requette->execute(array()); 

	  	$resultat=$requette->FetchAll(PDO::FETCH_ASSOC); 
	  	
        if(empty($resultat))
        	return false; 
        else
        	return true; 
      
	  }  
}

?>