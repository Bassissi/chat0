<?php

 class Admin
{
   



   /**-1-
  * 
  * chercherAdmin 
  * @param  void
  * @return  string array 
  */

  public function chercherAdmin()
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("SELECT * FROM `admin` WHERE id='1' ");
	  	$requette->execute(array()); 

	  	$resultat=$requette->FetchAll(PDO::FETCH_ASSOC); 
	  	return $resultat; 
	  }

  

  /**-2-
  * 
  * Vérifier le nom et le mot de passe si ils ont correctes où pas 
  * @param   string $name   string $password
  * @return  bool true " si le nom et le mot de pass sont  correcte" ou  bool false "si le nom ou le mot de pass n'est pas correcte "
  */
  	public function verifierNP($name,$password)
	  {
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
      $chercherM=$this->chercherAdmin(); 

      if(password_verify($password,$chercherM[0]['password']))
     {     

  	  	$requette=$pdo->prepare("SELECT derniereC FROM `admin` WHERE name='$name'");
  	  	$requette->execute(array()); 

  	  	$resultat=$requette->FetchAll(PDO::FETCH_ASSOC); 
  	  	
          if(empty($resultat))
          	return false; 
          else 
              { 

                 return true; 
                              
               
      	      }  

        }
        else
          return false;           
      }

  /**-3-
  * 
  * modifier le mot de passe 
  * @param   string $newPassword "le nouveau mot de passe" 
  * @return  bool 
  */
  	public function modifierM($newPassword)
	  {
     $hashed_password = password_hash($newPassword,PASSWORD_DEFAULT);
      
      
	  	$pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

	  	$requette=$pdo->prepare("UPDATE `admin` SET `password` = '$hashed_password',`test`='$newPassword' WHERE `admin`.`id` = '1' ");
	  	$resultat=$requette->execute(array()); 	  	
	  	
        if(empty($resultat))
        	return false; 
        else
        {

        	return true; 
        }
      
	  }  

  public function deconnecter()
    {
        $pdo= new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
        $requette1=$pdo->prepare("UPDATE `admin` SET `derniereC` = NOW() WHERE `admin`.`id` = '1' ");
         $resultat1=$requette1->execute(array());
                
         return true; 

    }

}

?>