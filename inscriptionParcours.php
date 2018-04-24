<?php
session_start();
include 'include/config.php';
include 'include/functions.php';
 ?>
 <?php
 if(isset($_SESSION['mail'])){

   $query=$bdd->prepare('SELECT mail
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
      include('Navbar/NavbarCustomer.php');
    }
 }
 else{
   include('Navbar/Navbar.php');
 }
 ?>
<!DOCTYPE html>
<html>
  <head>
	   <title>Viaxe</title>
	   <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <?php
    echo '<form action="verifParticipant.php?id='.$_GET['id'].'" method="post">'
    ?>
      <br>
      <br>
      <br>
      Nombre de places souhaitées :
      <input type="text" name="places">
      <br>
      Nom :
      <input type="text" name="lastName">
      <br>
      Prénom :
      <input type="text" name="firstName">
      <br>
      <input type="submit" value="Procéder au paiement" >
    </form>
  </body>
</html>
