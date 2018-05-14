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
    <titleRecherche</title>
    <link rel="stylesheet" href="css/style1.css" type="text/css">
    <link rel="stylesheet" href="css/style2.css" type="text/css">
    <link rel="stylesheet" href="css/style3.css" type="text/css">
  </head>
  <header>
  <body>
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

    <?php
    //initialisation des variables d'erreurs

        $now = strtotime("now") + 7200;


    //On check si il a rentré un guide

        if(!empty($_POST['guide']))
    	{
        $guide = $_POST['guide'];
        $prereq=$bdd->prepare('SELECT * FROM GUIDE WHERE pseudo = :pseudo');
        $prereq->bindValue(':pseudo',$guide, PDO::PARAM_STR);
        $prereq->execute();
        }



              $con = mysqli_connect("localhost","root","","viaxe");



              echo '<div class="py-5">
                <div class="container">
                  <div class="row">';




        	while($row=$prereq->fetch())
        	{

          $date = strtotime($row['age']);
          $id = $row['id'];
          $mark = $row['mark'] * 20;
          $note = $row['mark'];
          if ($row['gender']==1) {
            $genre = "Homme";
          }
          else {
            $genre = "Femme";
          }
            echo '
            <div class="col-md-4 align-self-center bg-light">
              <a href = seeProfil.php?id='.$row['id']."&role=g".'>
                <img class="img-fluid d-block" width="350px" src="'.$row['picture'].'">
              </a>
              <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$mark.'%" aria-valuenow="'.$mark.'" aria-valuemin="0" aria-valuemax="100">'.$note.'/5</div>
              </div>
              <a href = seeProfil.php?id='.$id."&role=g".'>
                <h3 class="my-3 w-100">'.$row['pseudo'].'</h3>
              </a>
              <p class="w-100">'.$row['firstName'].', '.$genre.'</p>
            </div>
            ';
        }

        echo '</div>
        </div>
        </div>';

        ?>
        </body>
        </html>
