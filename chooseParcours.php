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
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Choix du type de parcours :</h1>
        </div>
      </div>
    </div>
  </div>
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 align-self-center">
            <?php
            if($data['diploma'] == "ok"){
            echo
            '<a href="createParcours?type=1.php">';
            }
            ?>
            <img class="img-fluid d-block" src="images/utiles/culturel.jpg" width="90%">
            <h3 class="my-3 text-center">Parcours Culturel</h3>
            <?php
            if($data['diploma'] == "ok"){
            echo
            '</a>';
            }
            ?>
            <p class="">Parcours réservés aux guides avec un diplôme vérifié, afin de visiter un monument et de connaître l'histoire qui lui est associé. Réservé aux vétérans <br> des parcours</p>
          </div>
          <div class="col-md-6 align-self-center">
            <a href="createParcours?type=2.php">
            <img class="img-fluid d-block" src="images/utiles/culinaire.jpg" width="100%">
            <h3 class="my-3 text-center">Parcours Culinaire</h3>
            </a>
            <p class="">Parcours pour éveiller les papilles et faire découvrir aux plus grands gourmets les routes des vins, ou tout simplement des restaurants ou bars conviviaux. Ne nécessite pas de diplôme particulier</p>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>
