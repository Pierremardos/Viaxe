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


 if($numberCustomer > $restPlaces){
   echo " <br> <br> <br>Erreur, le nombre de participant est trop grande la limite est de $restPlaces";
 }
 else{

 $req = $bdd->prepare('INSERT INTO PARTICIPANT (time, numberCustomer, mailCustomer, idTrip)
  VALUES (NOW(), :places, :mail, :trip)');


 $req->execute(array(
   "places"=>$numberCustomer,
   "mail"=>$mail,
   "trip"=>$_GET['id']
   ));

   $query=$bdd->prepare('UPDATE TRIP SET places = :places
    WHERE id = :id');

    $query->execute(array(
      "places"=>($restPlaces - $numberCustomer),
      "id"=>$_GET['id']
      ));

      $rep=$bdd->prepare('SELECT level
      FROM CUSTOMER WHERE mail = :mail');
      $rep->bindValue(':mail',$mail, PDO::PARAM_STR);
      $rep->execute();
      $donnees=$rep->fetch();
      $lvl = $donnees['level'];
      if($lvl < 200){
        $lvl = $lvl + 50;
      }
      else if($lvl < 300 & $lvl >= 200){
        $lvl = $lvl + 20;
      }
      else if($lvl < 400 & $lvl >= 300){
        $lvl = $lvl + 10;
      }
      else{
        $lvl = $lvl + 5;
      }

      $query=$bdd->prepare('UPDATE CUSTOMER SET level = :level
       WHERE mail = :mail');

       $query->execute(array(
         "level"=>$lvl,
         "mail"=>$mail
         ));

     header("Location: parcours.php?id=".$_GET['id']."");
     exit;
   }

 ?>
