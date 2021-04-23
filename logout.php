<?php
include 'config/config.php'; 
include 'Admin_class.php';
session_start();
$admin =new Admin(); 
$deconnecte=$admin->deconnecter(); 
$_SESSION['connected']=false; 
$template='login.phtml';
include "admin.phtml"; 

?>