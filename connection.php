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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Viaxe</title>
  </head>
  <header>
    <?php include('Navbar.php');?>
  </header>
  <body>
     <br><br><br>
	   <form method="post" action="verifConnexion.php">
    Pseudo : <input type="text"name="pseudo"  placeholder="pseudo" /> <br>
	  Mot de Passe :<input type="password" name="password" placeholder="password" />
	<input type="submit" value="Connexion" />
    </form>
	</body>
</html>
