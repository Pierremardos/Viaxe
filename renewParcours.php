<?php
  session_start();
  include 'include/config.php';
  include 'include/functions.php';


$date = $_POST['date'] . " " . htmlspecialchars($_POST['departHour']) . ":" . htmlspecialchars($_POST['departMin']) . ":00";
$language = htmlspecialchars($_POST['language']);
$price = htmlspecialchars($_POST['price']);
$places = htmlspecialchars($_POST['place']);
$finalPrice = htmlspecialchars($_POST['finalPrice']);
$finalDate = $_POST['finalDate'] . " " . htmlspecialchars($_POST['finalHour']) . ":" . htmlspecialchars($_POST['finalMin']) . ":00";
$id = htmlspecialchars($_GET['id']);

$query=$bdd->prepare('SELECT *
FROM TRIP WHERE id = :id');
$query->bindValue(':id',$id, PDO::PARAM_STR);
$query->execute();
$data=$query->fetch();

$req = $bdd->prepare('INSERT INTO TRIP (title, map, date, picture, duration, country, city, languages, price, finalPrice,datePrice,category,places,mark, mailGuide)
 VALUES ( :title, :map, :dateDep, :picture, :duration, :country, :city, :language, :price, :finalPrice, :finalDate, :category, :places, :mark, :mailGuide)');


$req->execute(array(
  "title"=>$data['title'],
  "map"=>$data['map'],
  "dateDep"=>$date,
  "picture"=>$data['picture'],
  "duration"=>$data['duration'],
  "city"=>$data['city'],
  "country"=>$data['country'],
  "language"=>$language,
  "price"=>$price,
  "finalPrice"=>$finalPrice,
  "finalDate"=>$finalDate,
  "category"=>$data['category'],
  "places"=>$places,
  "mark"=>$data['mark'],
  "mailGuide"=>$_SESSION['mail']
  ));

  $query = $bdd ->prepare('SELECT MAX(id) FROM TRIP');
  $query->execute();
  $donnees = $query->fetch();
  $idMax = $donnees['0'];
  $idMax = $idMax + 1;

  $query = $bdd->prepare('UPDATE RECOMMENDATION SET idTrip = :idMax WHERE idTrip = :id');


  $query->execute(array(
    "idMax"=>$idMax,
    "id"=>$id
    ));

  $rep = $bdd->prepare('UPDATE TRIP SET statut = :statut WHERE id = :id');
  $rep->execute(array(
    "statut"=>"dead",
    "id"=>$id
    ));

    header('location: parcours.php?id='.$idMax.'');
    exit;
