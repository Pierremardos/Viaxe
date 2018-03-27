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
echo "salut";
echo "$Searsh[country]";

 ?>
