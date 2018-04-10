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
      Date du parcours :
      <select name="day">
        <option value="1" selected>1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
      <select name="month">
        <option value="01" selected>Janvier</option>
        <option value="02">Février</option>
        <option value="03">Mars</option>
        <option value="04">Avril</option>
        <option value="05">Mai</option>
        <option value="06">Juin</option>
        <option value="07">Juillet</option>
        <option value="08">Août</option>
        <option value="09">Septembre</option>
        <option value="10">Octobre</option>
        <option value="11">Novembre</option>
        <option value="12">Décembre</option>
      </select>
      <select name="year">
        <option value="2018" selected>2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2020</option>
      </select>
      <br>
      Durée du parcours : <input type="text" name="durationHour">h
      <input type="text" name="durationMin">min
      <br>
      Heure de départ : <input type="text" name="departHour">h
      <input type="text" name="departMin">min
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
      Date et heure d'application de la réduction :
      <select name="finalDay">
        <option value="1" selected>1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
      <select name="finalMonth">
        <option value="01" selected>Janvier</option>
        <option value="02">Février</option>
        <option value="03">Mars</option>
        <option value="04">Avril</option>
        <option value="05">Mai</option>
        <option value="06">Juin</option>
        <option value="07">Juillet</option>
        <option value="08">Août</option>
        <option value="09">Septembre</option>
        <option value="10">Octobre</option>
        <option value="11">Novembre</option>
        <option value="12">Décembre</option>
      </select>
      <select name="finalYear">
        <option value="2018" selected>2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2020</option>
      </select>
      <br>
      <input type="text" name="finalHour">h
      <input type="text" name="finalMin">min
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
