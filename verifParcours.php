<?php
  session_start();
 ?>

 <?php

 try
 {
   $bdd = new PDO('mysql:host=localhost;dbname=viaxe;charset=utf8', 'root', '');
 }
 catch(Exception $e)
 {
         die('Erreur : '.$e->getMessage());
 }

 $title = $_POST['title'];
 $duration = $_POST['duration'];
 $city = $_POST['city'];
 $country = $_POST['country'];
 $language = $_POST['language'];
 $price = $_POST['price'];
 $category = $_POST['categorie'];
 $places = $_POST['place'];
 $finalPrice = $_POST['finalPrice'];
 $content = $_POST['content'];

 $req = $bdd->prepare('INSERT INTO TRIP (title, date, duration, country, city, languages, price, finalPrice,datePrice,category,places,content)
  VALUES ( :title, NOW(), :duration, :country, :city, :language, :price, :finalPrice, NOW(), :category, :places, :content)');


 $req->execute(array(
   "title"=>$title,
   "duration"=>$duration,
   "city"=>$city,
   "country"=>$country,
   "language"=>$language,
   "price"=>$price,
   "finalPrice"=>$finalPrice,
   "category"=>$category,
   "places"=>$places,
   "content"=>$content
   ));

 header("location: index.php");

?>
