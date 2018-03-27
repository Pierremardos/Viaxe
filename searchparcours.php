<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header>
      <?php include 'Navbar.php' ?>
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
    }

    if (isset($_POST['city'])){
    $city = ($_POST['city']);
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


    //recherche par vile
    $query=$bdd->prepare('SELECT * FROM trip WHERE city =:city');
    $query->bindValue(':city',$city, PDO::PARAM_STR);
    $query->execute();
    $Searsh=$query->fetch();
    $query->CloseCursor();


     ?>
    <div class="Resultat" class="container">
      <br><br><br><br>
      <?php
      echo "$Searsh[title] <br>";
      echo "$Searsh[languages] <br>";
      echo "$Searsh[city] <br>";
      echo "$Searsh[country] <br>";
      echo "$Searsh[price] <br>";
      echo "$Searsh[places] <br>";
      echo "$Searsh[content] <br>";
       ?>

    </div>
  </body>
</html>
