<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <header>
  <body>
    <?php
		if(isset($_SESSION['mail'])){

		  $query=$bdd->prepare('SELECT *
		  FROM GUIDE WHERE mail = :mail');
		  $query->bindValue(':mail',$_SESSION['mail'], PDO::PARAM_STR);
		  $query->execute();
		  $data=$query->fetch();

      if($_SESSION['mail'] == 'quentin.clodion@gmail.com' | $_SESSION['mail'] =='jonasnizard@gmail.com' | $_SESSION['mail'] == 'thomas.ddt@hotmail.fr'){
        include('Navbar/NavbarAdmin.php');
      }
      else if ($_SESSION['mail'] == $data['mail'])
		   {
		       include('Navbar/NavbarGuide.php');
		   }
		   else{
		     header("location: index.php");
         exit;
		   }
		}
		else{
      header("location: index.php");
      exit;
		}
	?>
  <?php
  $id = $_GET['id'];
  $rep=$bdd->prepare('SELECT *
  FROM PARTICIPANT WHERE idTrip = :id');
  $rep->bindValue(':id',$id, PDO::PARAM_STR);
  $rep->execute();
  while($data=$rep->fetch()){
    
  }
