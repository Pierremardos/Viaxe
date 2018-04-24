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
 $query=$bdd->prepare('SELECT places
 FROM TRIP WHERE id = :id');
 $query->bindValue(':id',$_GET['id'], PDO::PARAM_STR);
 $query->execute();
 $data=$query->fetch();

 $restPlaces = $data['places'];
 $numberCustomer = $_POST['places'];
 $mail = $_SESSION['mail'];
 $lastName = $_POST['lastName'];
 $firstName = $_POST['firstName'];

 if($numberCustomer > $restPlaces){
   echo " <br> <br> <br>Erreur, le nombre de participant est trop grande la limite est de $restPlaces";
 }
 else{

 $req = $bdd->prepare('INSERT INTO PARTICIPANT (orderNumber, time, numberCustomer, firstName, lastName, mailCustomer, idTrip)
  VALUES ( 5, NOW(), :places, :firstName, :lastName, :mail, :trip)');


 $req->execute(array(
   "places"=>$numberCustomer,
   "firstName"=>$firstName,
   "lastName"=>$lastName,
   "mail"=>$mail,
   "trip"=>$_GET['id']
   ));

   $query=$bdd->prepare('UPDATE TRIP SET places = :places
    WHERE id = :id');

    $query->execute(array(
      "places"=>($restPlaces - $numberCustomer),
      "id"=>$_GET['id']
      ));


     header("Location: index.php");
     exit;
   }

 ?>
