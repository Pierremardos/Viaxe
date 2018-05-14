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
    <title>Recherche</title>
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
    $now = strtotime("now") + 7200;

    //varriable de $bdd
    $cityCount = 0;
    $categorieCount = 0;
    $langageCount = 0;
    $prixCount = 0;
    $placeCount = 0;
    $dateCount = 0;

//On verifie que l'utilisateur à bien rentré les données

    if(!empty($_POST['city']))
	{
    $city =$_POST['city'];
    $cityCount++;
    }

	if(!empty($_POST['prix']))
	{
      $prix = $_POST['prix'];
      $prixCount++;
    }

	if(!empty($_POST['place']))
	{
    $place =$_POST['place'];
    $placeCount ++;
    }

	if(!empty($_POST['date']))
	{
      $date = $_POST['date'];
      $dateCount ++;
    }

	  if(!empty($_POST['categorie']))
	{
    $categorie =$_POST['categorie'];
    $categorieCount ++;
    }

	  if(empty($_POST['langage']))
	{
      $langage =$_POST['langage'];
      $langageCount++;
    }

  // commande SQL sachant que la catégorie, le prix et les places sont automatiquement définie

  //si un des trois est définie
  if ($cityCount !=0 || $langageCount !=0 || $dateCount !=0) {
    //si la ville est mise
    if ($cityCount !=0 ) {
      //ville + langue
      if ($langageCount !=0) {
        $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND city = '$city' AND languages = '$langage'";
      }
      //ville + date
      if ($dateCount !=0) {
        $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND city = '$city' AND date >'$date'";
      }
      if ($dateCount == 0 && $langageCount == 0){
        $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND city = '$city'";
      }
    }
    //si la langue est mise
    if ($langageCount !=0 ) {
      //si la langue + ville
      if ($cityCount !=0) {
        $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND city = '$city' AND languages = '$langage'";
      }
      // langue + date
      if ($dateCount !=0) {
        $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND languages = '$langage' AND date >'$date'";
      }
      if ($dateCount == 0 && $cityCount == 0){
        $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND languages = '$langage'";
      }
    }
    
    //si la date est mise
    if ($dateCount != 0) {
      //si la date + ville
      if ($cityCount !=0) {
        $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND city = '$city' AND date >'$date'";
      }
      //date + langue
      if ($langageCount !=0) {
        $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND languages = '$langage' AND date >'$date'";
      }
      if ($cityCount == 0 && $langageCount == 0){
        $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND date >'$date'";
      }
    }
    //si tous est définie
    if ($cityCount !=0 && $langageCount !=0  && $dateCount != 0) {
      $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = '$place' AND city = '$city' AND languages = '$langage' AND date >'$date'";
    }
  }
  // si il y a juste la base
  else{
    $prereq="SELECT * FROM trip WHERE categorie='$categorie' AND price = '$prix' AND places = $place";

  }
//Une fois la vérification efféctué on se connecte à la base de données
echo "City = ".$cityCount;
echo "Cat = ".$categorieCount;
echo "lang = ".$langageCount;
echo "prix = ".$prixCount;
echo "place = ".$placeCount;
echo "date = ".$dateCount;

      $con = mysqli_connect("localhost","root","","viaxe");



      echo '<div class="py-5">
        <div class="container">
          <div class="row">';


	$requete=mysqli_query($con,$prereq);

	while($row = mysqli_fetch_array($requete))
	{

  $date =strtotime($row['date']);
  $places = $row['places'];
  $id = $row['id'];
  $mark = $row['mark'];

  if($date >= $now and $places > 0){
    echo '
    <div class="col-md-4 align-self-center bg-light">
      <a href = parcours.php?id='.$row['id'].'>
        <img class="img-fluid d-block" width="350px" src="'.$row['picture'].'">
      </a>
      <div class="progress">
        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$mark.'%" aria-valuenow="'.$mark.'" aria-valuemin="0" aria-valuemax="100">'.$mark.'/100</div>
      </div>
      <a href = parcours.php?id='.$id.'>
        <h3 class="my-3 w-100">'.$row['title'].'</h3>
      </a>
      <p class="w-100">'.$row['price'].'€</p>
      <p class="w-100">'.$row['city'].', '.$row['country'].'</p>
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
