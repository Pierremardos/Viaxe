<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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
<?php
include 'include/config.php';

    // recuperation des donnée du formulaire

    if (isset($_POST['title'])){
      $title = $_POST['title'];
    }

    if (isset($_POST['date'])){
    $date = ($_POST['date']);
    }

    if (isset($_POST['duration'])){
    $duration = ($_POST['duration']);
    }

    if (isset($_POST['country'])){
    $country = $_POST['country'];
    //recherche par pays
    $query=$bdd->prepare('SELECT * FROM trip WHERE country =:city');
    $query->bindValue(':city',$city, PDO::PARAM_STR);
    $query->execute();
    $Searsh=$query->fetch();
    $query->CloseCursor();
    }

    if (isset($_POST['city'])){
    $city = ($_POST['city']);
    //recherche par vile
    $query=$bdd->prepare('SELECT * FROM trip WHERE city =:city');
    $query->bindValue(':city',$city, PDO::PARAM_STR);
    $query->execute();
    $Searsh=$query->fetch();
    $query->CloseCursor();
    }

    if (isset($_POST['languages'])){
    $languages = ($_POST['languages']);
    }

    if (isset($_POST['price'])){
    $price = ($_POST['price']);
    }

    if (isset($_POST['category'])){
    $category = ($_POST['category']);
    }








     ?>
    <div class="resultat">
      <br><br><br><br
      <?php
      echo "Titre : $Searsh[title] <br>";
      echo "Ville : $Searsh[city] <br>";
      echo "Pays : $Searsh[country] <br>";
      echo "Prix: $Searsh[price] <br>";
      echo "Nombres de places : $Searsh[places] <br>";
      echo "Résumé : $Searsh[content] <br>";
       ?>

    </div>
  </body>
</html>