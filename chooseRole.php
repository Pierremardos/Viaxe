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
    <title>Role</title>
  </head>
  <header>
    <?php
		if(isset($_SESSION['mail'])){

		  $query=$bdd->prepare('SELECT mail
		  FROM GUIDE WHERE mail = :mail');
		  $query->bindValue(':mail',$_SESSION['mail'], PDO::PARAM_STR);
		  $query->execute();
		  $data=$query->fetch();

		   if ($_SESSION['mail'] == $data['mail'])
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
  </header>
  <body>
      <br>
      <br>
      <h1>Quel type de compte voulez vous créer ?</h1>
      <a href="inscription.php">Client </a>
      <br>
      <a href="inscription2.php">Guide</a>
  </body>
</html>
