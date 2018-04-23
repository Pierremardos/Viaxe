<?php
session_start();
include 'include/config.php';
include 'include/functions.php';
 ?>
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
 $req = $bdd->prepare('INSERT INTO PARTICIPANT (orderNumber, time, numberCustomer, firstName, lastName, mailCustomer)
  VALUES ( :title, NOW(), :dateDep, :picture, :duration, :country, :city, :language, :price, :finalPrice, :finalDate, :category, :places, :content, :pic1, :pic2, :pic3, :mailGuide)');


 $req->execute(array(
   "title"=>$title,
   "map"=>$map,
   "dateDep"=>$date,
   "picture"=>$picture,
   "duration"=>$duration,
   "city"=>$city,
   "country"=>$country,
   "language"=>$language,
   "price"=>$price,
   "finalPrice"=>$finalPrice,
   "finalDate"=>$finalDate,
   "category"=>$category,
   "places"=>$places,
   "content"=>$content,
   "pic1"=>$pic1,
   "pic2"=>$pic2,
   "pic3"=>$pic3,
   "mailGuide"=>$mail
   ));
 ?>
