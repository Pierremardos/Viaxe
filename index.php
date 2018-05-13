<?php
session_start();
include 'include/config.php';
include 'include/functions.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Viaxe</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style1.css" type="text/css">
  <link rel="stylesheet" href="css/style2.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/slider.css">
  <link rel="icon" type="image/ico" href="image/favicon.ico" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
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
	<main>
    <div class="py-5 text-center h-100" style="background-image: url(&quot;https://pingendo.github.io/templates/sections/assets/cover_event.jpg&quot;); background-size: cover;">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-12">
            <h1 class="display-3 mb-4 text-primary">Qu'est ce que Viaxe ?</h1>
            <p class="lead mb-5">Viaxe est un site de recherche de parcours avec des thèmes plus ou moins variés. Les guides qui sont indépendants de nous, vont poster des parcours aux 4 coins de notre globe pour vous aider à le découvrir et le comprendre. Notre rôle est de
            vous présenter ces parcours afin que vous puissez trouver celui qui correspond le plus à vos attentes. Bienvenue et bonne recherche.</p>
          </div>
        </div>
      </div>
    </div>

		<div class="search container">
			<form action="searchparcours.php" method="post">
				Je recherche :
				<br>
				<br>

        Recherche par ville ou pays :
				<input type="search" name="city" placeholder="Recherche par Ville ou par pays">
        <br>
        Recherche par guide :
        <input type="search" name="guide" placeholder="Recherche par guide">
				<br>
				<br>
        <p id="price">Prix : 250</p>

			  <div class="slidecontainer">
          <input type="range" name="prix" min="1" max="500" value="250" class="slider" onclick="price()" id="firstSlider">
        </div>
        <script src="include/slider.js"></script>
        <br>
        <p>
          <p id="place">Nombre de places : 10</p>
  			  <div class="slidecontainer">
            <input type="range" name="place" min="1" max="20" value="10" class="slider" onclick="nombrePlace()" id="secondSlider">
          </div>
          <script src="include/slider.js"></script>
          <br>
				Date :
				<input type="date" name="date">
				Categorie :
				<select name="categorie">
					<option value="culturel" selected>Culturel</option>
					<option value="food">Culinaire</option>
					<option value="fun">Ludique</option>
				</select>
				Langue 1 :
				<select name="langage">

					<option value="undefined">Indefini</option>
					<option value="fr">Francais</option>
          <option value="en">Anglais</option>
				</select>
			  <br>
				<br>
				<br>
				<input type="submit" value="Recherche" readonly style="margin-left: 1030px;">
			</form>
		</div>
<?php
  $now = strtotime("now") + 7200;
  $query=$bdd->prepare('SELECT * FROM TRIP');
  $query->execute();
  $count = 1;

  while($donnees = $query->fetch())
  {
    $places = $donnees['places'];
    $mark = $donnees['mark'] * 20;
    $date = strtotime($donnees['date']);
    if($date - $now <= 86400 & $date - $now > 0 & $count < 2 & $places > 0){
      echo'
        <div class="py-5 bg-primary">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1 class="text-center">Les parcours de la journée</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="py-5">
          <div class="container">
            <div class="row">';
      $count = $count + 1;
    }
      if($date - $now <= 86400 & $date - $now > 0 & $count < 5 & $places > 0){
        echo '
          <div class="col-md-4 align-self-center bg-light">
            <a href = parcours.php?id='.$donnees['id'].'>
              <img class="img-fluid d-block" width="350px" src="'.$donnees['picture'].'">
            </a>
            <div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$mark.'%" aria-valuenow="'.$mark.'" aria-valuemin="0" aria-valuemax="100">'.$mark.'/100</div>
            </div>
            <a href = parcours.php?id='.$donnees['id'].'>
              <h3 class="my-3 w-100">'.$donnees['title'].'</h3>
            </a>
            <p class="w-100">'.$donnees['price'].'€</p>
            <p class="w-100">'.$donnees['city'].', '.$donnees['country'].'</p>
          </div>';
        $count = $count + 1;
          }
        }


        $query2=$bdd->prepare('SELECT * FROM TRIP WHERE category = "Culinaire"');
        $query2->execute();
        $count = 1;
        while($donnees = $query2->fetch())
        {
          $places = $donnees['places'];
          $date = strtotime($donnees['date']);
          $mark = $donnees['mark'] * 20;
          if($date > $now & $count < 2 & $places > 0){
            echo'
        </div>
      </div>
    </div>
    <div class="py-5 bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Côté cuisine
            <br>
          </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">';
      $count = $count + 1;
    }
          if($date > $now & $count > 1 & $count < 5 & $places > 0){
            echo '
            <div class="col-md-4 align-self-center bg-light">
              <a href = parcours.php?id='.$donnees['id'].'>
              <img class="img-fluid d-block" src="'.$donnees['picture'].'">
              </a>
              <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$mark.'%" aria-valuenow="'.$mark.'" aria-valuemin="0" aria-valuemax="100">'.$mark.'/100</div>
              </div>
              <a href = parcours.php?id='.$donnees['id'].'>
              <h3 class="my-3 w-100">'.$donnees['title'].'</h3>
              </a>
              <p class="w-100">'.$donnees['price'].'€</p>
              <p class="w-100">'.$donnees['country'].', '.$donnees['city'].'</p>
            </div>';
            $count = $count + 1;
          }}


          $query3=$bdd->prepare('SELECT * FROM TRIP ORDER BY mark DESC');
          $query3->execute();
          $count = 1;
          while($donnees = $query3->fetch())
          {
            $places = $donnees['places'];
            $mark = $donnees['mark'] * 20;
            $date = strtotime($donnees['date']);
            if($date > $now & $count < 2 & $places > 0){
              echo'
              </div>
            </div>
          </div>
        <div class="py-5 bg-primary">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1 class="text-center">Les coups de coeur
                <br>
                </h1>
              </div>
            </div>
          </div>
        </div>
      <div class="py-5">
        <div class="container">
          <div class="row">';
    $count = $count + 1;
  }
  if($date > $now & $count < 5 & $places > 0){
    echo
    '<div class="col-md-4 align-self-center bg-light">
      <a href = parcours.php?id='.$donnees['id'].'>
        <img class="img-fluid d-block" src="'.$donnees['picture'].'">
      </a>
      <div class="progress">
        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$mark.'%" aria-valuenow="'.$mark.'" aria-valuemin="0" aria-valuemax="100">'.$mark.'/100</div>
      </div>
      <a href = parcours.php?id='.$donnees['id'].'>
        <h3 class="my-3 w-100">'.$donnees['title'].'</h3>
      </a>
      <p class="w-100">'.$donnees['price'].'€</p>
      <p class="w-100">'.$donnees['country'].', '.$donnees['city'].'</p>
    </div>';
      $count = $count + 1;
    }}
    ?>
      </div>
    </div>
  </div>
</div>
</main>
</body>
</html>
