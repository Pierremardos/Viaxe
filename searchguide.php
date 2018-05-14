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
        $guide =$_POST['guide'];
        $prereq="SELECT * FROM GUIDE WHERE pseudo = : $guide";

        }



              $con = mysqli_connect("localhost","root","","viaxe");



              echo '<div class="py-5">
                <div class="container">
                  <div class="row">';


        	$requete=mysqli_query($con,$prereq);

        	while($row = mysqli_fetch_array($requete))
        	{

          $date =strtotime($row['date']);
          $id = $row['id'];
          $mark = $row['mark'];
          if ($row['genre']==1) {
            $genre = "Homme";
          }
          else {
            $genre = "Femme";
          }

          if($date >= $now and $places > 0){
            echo '
            <div class="col-md-4 align-self-center bg-light">
              <a href = seeProfil.php?id='.$row['id'].'>
                <img class="img-fluid d-block" width="350px" src="'.$row['picture'].'">
              </a>
              <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$mark.'%" aria-valuenow="'.$mark.'" aria-valuemin="0" aria-valuemax="100">'.$mark.'/100</div>
              </div>
              <a href = seeProfil.php?id='.$id.'>
                <h3 class="my-3 w-100">'.$row['pseudo'].'</h3>
              </a>
              <p class="w-100">'.$row['pseudo'].'</p>
              <p class="w-100">'.$row['firstName'].', '.$gendre.'</p>
            </div>
            ';
          }

        }

        echo '</div>
        </div>
        </div>';

        mysqli_free_result($requete);

        ?>
        </body>
        </html>
