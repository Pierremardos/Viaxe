<?php
  session_start();
  include 'include/config.php';
  include 'include/functions.php';

  if(isset($_SESSION['mail'])){

    $query=$bdd->prepare('SELECT *
    FROM TRIP WHERE id = :id');
    $query->bindValue(':id',$_GET['id'], PDO::PARAM_STR);
    $query->execute();
    $data=$query->fetch();

    if($_SESSION['mail'] == 'quentin.clodion@gmail.com' | $_SESSION['mail'] =='jonasnizard@gmail.com' | $_SESSION['mail'] == 'thomas.ddt@hotmail.fr'){
      include('Navbar/NavbarAdmin.php');
    }
   else if ($_SESSION['mail'] == $data['mailGuide'])
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

  $title = htmlspecialchars($_POST['title']);
  if(!isset($title) | empty($title)){
    $error++;
    echo "Le titre n'a pas été rentré<br>";
  }

  if(!isset($_POST['date']) | empty($_POST['date'])){
     echo "La date de départ n'a pas été rentré<br>";
  }
  if($_POST['departHour'] > 23 | $_POST['departHour'] < 0){
      echo "Le format de l'heure de départ n'est pas valide<br>";
  }
  else if(!isset($_POST['departHour']) | empty($_POST['departHour'])){
    $_POST['departHour'] = 0;
  }
  if($_POST['departMin'] > 59 | $_POST['departMin'] < 0){
    echo "Le format des minutes de l'heure de départ n'a pas été rentré<br>";
  }
  else if(!isset($_POST['departMin']) | empty($_POST['departMin'])){
    $_POST['departMin'] = 0;
  }
$date = $_POST['date'] . " " . htmlspecialchars($_POST['departHour']) . ":" . htmlspecialchars($_POST['departMin']) . ":00";
$duration = ($_POST['durationHour']*60) + $_POST['durationMin'];

$accept = 0;
$error = 0;

$req = $bdd ->prepare('SELECT MAX(id) FROM TRIP');
$req->execute();
$donnees = $req->fetch();
$idMax = $donnees['0'];
$idMax = $idMax + 1;
$id = htmlspecialchars($_GET['id']);

$query=$bdd->prepare('SELECT *
FROM TRIP WHERE id = :id');
$query->bindValue(':id',$id, PDO::PARAM_STR);
$query->execute();
$data=$query->fetch();


$language = htmlspecialchars($_POST['language']);
if(!isset($language) | empty($language)){
  echo "Les langues maîtrisés n'ont pas été rentré<br>";
  $error++;
}

$price = htmlspecialchars($_POST['price']);
if(!isset($price) | empty($price)){
  $error++;
  echo "Le prix n'a pas été rentré<br>";
}
else if($price > 500){
  $error++;
  echo "Le prix doit être inférieur à 500<br>";
}

$places = htmlspecialchars($_POST['place']);
if(!isset($places) | empty($places)){
  $error++;
  echo "Le nombre de places n'a pas été rentré<br>";
}

$now = strtotime("now") + 7200;
$finalPrice = htmlspecialchars($_POST['finalPrice']);

if($finalPrice < 0){
  $error++;
   echo "Le prix de la réduction doit être positif<br>";
}

$max = strtotime($date);
if($max - $now < 36000 | $max - $now > 5356800){
  $error++;
  echo "La date du parcours est inférieur à la date actuelle ou trop loin dans la temps<br>";
}
if(!isset($max) | empty($max)){
  $error++;
  echo "La date du parcours n'a pas été rentrée <br>";
}

$finalDate = $_POST['finalDate'] . " " . htmlspecialchars($_POST['finalHour']) . ":" . htmlspecialchars($_POST['finalMin']) . ":00";


if($finalPrice != 0 | $_POST['finalHour'] != 0 | $_POST['finalMin'] != 0){
  if(!isset($finalPrice) | !isset($_POST['finalDate']) | empty($_POST['finalDate'])){
    $error++;
     echo "Le prix ou la date de la réduction n'a pas été rentré<br>";
  }
  if($_POST['finalHour'] > 23 | $_POST['finalHour'] < 0){
    $error++;
     echo "Le format de l'heure de réduction n'est pas valide<br>";
  }
  else if(!isset($_POST['finalHour']) | empty($_POST['finalHour'])){
    $_POST['finalHour'] = 0;
  }
  if($_POST['finalMin'] > 59 | $_POST['finalMin'] < 0){
    $error++;
    echo "Le format des minutes pour l'heure de réduction n'est pas valide<br>";
  }
  else if(!isset($_POST['finalMin']) | empty($_POST['finalMin'])){
    $_POST['finalMin'] = 0;
  }
}
else{
  if($error == 0){
  $req = $bdd->prepare('INSERT INTO TRIP (title, map, date, picture, duration, country, city, languages, price, finalPrice, datePrice, category,places,mark,mailGuide)
   VALUES ( :title, :map, :dateDep, :picture, :duration, :country, :city, :language, :price, :finalPrice, :datePrice, :category, :places, :mark, :mailGuide)');


  $req->execute(array(
    "title"=>$title,
    "map"=>$data['map'],
    "dateDep"=>$date,
    "picture"=>$data['picture'],
    "duration"=>$duration,
    "city"=>$data['city'],
    "country"=>$data['country'],
    "language"=>$language,
    "price"=>$price,
    "finalPrice"=>$price,
    "datePrice"=>$date,
    "category"=>$data['category'],
    "places"=>$places,
    "mark"=>$data['mark'],
    "mailGuide"=>$_SESSION['mail']
    ));
    $accept = 1;
}
}

if(isset($date) | !empty($date)){

 $reduc = strtotime($finalDate);

 if(isset($reduc) | !empty($reduc)){
 if($max < $reduc){
    $error++;
     echo "La date de réduction s'applique après le parcours<br>";
   }
  }
}

if($accept == 0 & $error == 0){
$req = $bdd->prepare('INSERT INTO TRIP (title, map, date, picture, duration, country, city, languages, price, finalPrice,datePrice,category,places,mark, mailGuide)
 VALUES ( :title, :map, :dateDep, :picture, :duration, :country, :city, :language, :price, :finalPrice, :finalDate, :category, :places, :mark, :mailGuide)');


$req->execute(array(
  "title"=>$title,
  "map"=>$data['map'],
  "dateDep"=>$date,
  "picture"=>$data['picture'],
  "duration"=>$duration,
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

$accept = 1;
}

  if($accept == 1){
    $rep = $bdd->prepare('UPDATE TRIP SET statut = :statut WHERE id = :id');
    $rep->execute(array(
      "statut"=>"old",
      "id"=>$id
      ));


    $query = $bdd->prepare('SELECT * FROM RECOMMENDATION WHERE idTrip = :id');
    $query->bindValue(':id',$id, PDO::PARAM_STR);
    $query->execute();
    while($data=$query->fetch()){

    $req = $bdd->prepare('INSERT INTO RECOMMENDATION (comment, timeComment, mark, mailCustomer, idTrip) VALUES (:comment, :timeComment, :mark, :mail, :idTrip)');
    $req->execute(array(
      "comment"=>$data['comment'],
      "timeComment"=>$data['timeComment'],
      "mark"=>$data['mark'],
      "mail"=>$data['mailCustomer'],
      "idTrip"=>$idMax
    ));

    }

    $query = $bdd->prepare('SELECT * FROM CONTENT WHERE idTrip = :id');
    $query->bindValue(':id',$id, PDO::PARAM_STR);
    $query->execute();
    while($data=$query->fetch()){

      $req = $bdd->prepare('INSERT INTO CONTENT (Picture, content, idTrip) VALUES (:picture, :content, :idTrip)');
      $req->execute(array(
        "picture"=>$data['Picture'],
        "content"=>$data['content'],
        "idTrip"=>$idMax
      ));

      }
  }

    if($error == 0){
      //header("location: parcours.php?id=".$idMax."");
      // exit;
   }

  echo'<a href="changeParcours.php?id='.$id.'"> Continuer la création </a>';
