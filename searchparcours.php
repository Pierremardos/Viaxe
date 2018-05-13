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
    $erreurvide=0;


//On verifie que l'utilisateur à bien rentré les données

    if(!empty($_POST['city']))
	{
    $city =$_POST['city'];
    $prereq="SELECT * FROM trip WHERE city='$city'";

    }

    if(!empty($_POST['guide']))
	{

    }

	if(empty($_POST['prix']))
	{
        $erreurvide++;
    }

	if(!empty($_POST['place']))
	{
    //$place =$_POST['place'];
    //$prereq="SELECT * FROM trip WHERE place>='$place'";
    }

	if(empty($_POST['date']))
	{
        $erreurvide++;
    }

	  if(empty($_POST['categorie']))
	{
        $erreurvide++;
    }

	  if(empty($_POST['langage']))
	{
        $erreurvide++;
    }

//Une fois la vérification efféctué on se connecte à la base de données



      $con = mysqli_connect("localhost","root","","viaxe");






	$requete=mysqli_query($con,$prereq);
  echo "<div>";
	while($row = mysqli_fetch_array($requete))
	{
  echo "<div class='col-md-4 align-self-center bg-light'>";

  //titre
  echo "Title : ";
  echo $row['title'];
  echo "<br>";

  //la photo
  $picbdd=$row['picture'];
  echo "<img class='img-fluid d-block' width='350px' src='".$picbdd."' alt=''/>";
  echo "<br>";


  //la ville
  echo "Ville : ";
	echo $row['city'];
  echo "<br>";

  //Pays
  echo "Pays : ";
	echo $row['country'];
  echo "<br>";

  //mark
  $mark = $row['mark'];
  echo '<div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$mark.'%" aria-valuenow="'.$mark.'" aria-valuemin="0" aria-valuemax="100">'.$mark.'/100</div>';


  echo "<br>";
  echo "</div>";
	}
  echo "</div>";



mysqli_free_result($requete);

?>
</body>
</html>
