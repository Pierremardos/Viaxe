<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Créer un parcours</title>
  </head>
  <body>
    <header>
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
    </header>
    <main>
      <br>
      <br>
      <br>
      <br>
    <form action="verifParcours.php" method="post" enctype='multipart/form-data'>
      Titre :<input type="text" name="title">
      <br>
     	 Photo de couverture du parcours : <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
       <input type='file' name='avatar'>
       <br>
      Date du parcours :<input type="datetime" name="dateParcours">
      <br>
      Durée du parcours : <input type="text" name="duration">
      <br>
      Pays du parcours :
      <select name="country">
        <option value="fr" selected>France</option>
        <option value="en">Angleterre</option>
        <option value="sp">Espagne</option>
        <option value="ge">Allemagne</option>
      </select>
      <br>
      Ville du parcours :
      <select name="city">
        <option value="paris" selected>Paris</option>
        <option value="london">London</option>
        <option value="barcelone">Barcelone</option>
        <option value="berlin">Berlin</option>
      </select>
      <br>
      Langues utilisés :
      <select name="language">
        <option value="frlangue" selected>Français</option>
        <option value="enlangue">English</option>
        <option value="splangue">Espanola</option>
        <option value="gelangue">Deutsch</option>
      </select>
      <br>
      Prix par client : <input type="text" name="price" >
      <br>
      Une réduction peut être appliqué à partir d'une certaine date afin de compléter son parcours.
      Si cela ne vous interesse laissez les champs vides.
      <br>
      Prix réduction : <input type="text" name="finalPrice">
      <br>
      Date et heure d'application de la réduction : <input type="datetime" name="datePrice">
      <br>
      Catégorie :
      <select name="categorie">
        <option value="culturel" selected>Culturel</option>
        <option value="gastronomie">Gastronomie</option>
      </select>
      <br>
      Places disponibles :
      <input type="text" name="place">
      <br>
      Présentation de votre parcours :
      <input type="text" name="content">
      <br>
      <input type="submit" value="Créer">
    </form>
  </main>
  </body>
</html>
