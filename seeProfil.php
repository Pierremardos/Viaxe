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
    <title></title>
  </head>
  <header>
  <body>
    <?php
		if(isset($_SESSION['mail'])){

		  $query=$bdd->prepare('SELECT *
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
  $role = $_GET['role'];
  $id = $_GET['id'];
  if($role == 'c'){
    $query=$bdd->prepare('SELECT *
    FROM CUSTOMER WHERE id = :id');
    $query->bindValue(':id',$id, PDO::PARAM_STR);
    $query->execute();
    $donnees=$query->fetch();
    echo
    '<div class="py-5">
       <div class="container">
         <div class="row">
           <div class="col-md-5 order-2 order-md-1">
             <img class="img-fluid d-block" src="'.$donnees['picture'].'" width="400px"> </div>
              <div class="col-md-7 order-1 order-md-2">
           <div class="col-md-7 order-1 order-md-2">

            Pseudo : '.$donnees['pseudo'].'<br>';
            if($donnees['level'] >= 100 & $donnees['level'] < 200){
              echo'Premiers pas';
            }
            else if($donnees['level'] >= 200 & $donnees['level'] < 300){
              echo'Nouveau marcheur';
            }
            else if($donnees['level'] >= 300 & $donnees['level'] < 400){
              echo'Aventurier';
            }
            else{
              echo"Marcheur de l'extrême";
            }
            echo'
             <br>Sexe : ';?>
             <?php if($donnees['gender']==1){
               echo "Homme";
             }
             else{
               echo "Femme";
             }
             ?>
             <?php echo'
             <br>Date de naissance : '.$donnees['age'].'
           </div>
         </div>
       </div>
     </div>';
  }
  else if($role == 'g'){
    $query=$bdd->prepare('SELECT *
    FROM GUIDE WHERE id = :id');
    $query->bindValue(':id',$id, PDO::PARAM_STR);
    $query->execute();
    $donnees=$query->fetch();
    echo
    '<div class="py-5">
       <div class="container">
         <div class="row">
           <div class="col-md-5 order-2 order-md-1">
             <img class="img-fluid d-block" src="'.$donnees['picture'].'" width="400px"> </div>
           <div class="col-md-7 order-1 order-md-2">
             <h3>'.$donnees['lastName'].' '.$donnees['firstName'].' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'.$note = round ($donnees['mark'], $precision = 1).'/5 &nbsp;</h3>
             <br>Sexe : ';?>
             <?php if($donnees['gender']==1){
               echo "Homme";
             }
             else{
               echo "Femme";
             }
             ?>
             <?php echo'
             <br>Date de naissance : '.$donnees['age'].'
             <br>Langues : '.$donnees['languages'].'
             <br>Pseudo : '.$donnees['pseudo'].'
             <br>Téléphone : '.$donnees['phone'].'
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="py-5">
       <div class="container">
         <div class="row">
           <div class="col-md-12">
             <div class="form-group">
               <label>Description :</label>
               <p>'.$donnees['description'].'</p>
               <small class="form-text text-muted"></small>
             </div>
           </div>
         </div>
       </div>
     </div>';
   ?>

   <div class="py-5 bg-primary">
       <div class="container">
         <div class="row">
           <div class="col-md-12">
             <h1 class="text-center">Parcours</h1>
           </div>
         </div>
       </div>
     </div>

    <?php

    $query->closeCursor();

    $query=$bdd->prepare('SELECT * FROM TRIP WHERE mailGuide = :mail');
    $query->bindValue(':mail',$donnees['mail'], PDO::PARAM_STR);
    $query->execute();
    $count = 0;




    while($donnees = $query->fetch())
    {
      $rep=$bdd->prepare('SELECT * FROM CONTENT WHERE idTrip = :id');
      $rep->bindValue(':id',$donnees['id'], PDO::PARAM_STR);
      $rep->execute();
      $data = $rep->fetch();

      $now = strtotime("now") + 7200;
      $dateDep = strtotime($donnees['date']);
    ?>

    <?php
    if($dateDep > $now & $donnees['places'] > 0){
      if($count % 2 == 0){
    echo '
     <div class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-7 align-self-center">
              <a href = parcours.php?id='.$donnees['id'].'>
              <h3>'.$donnees['title'].'</h3>
              </a>
              <p class="my-3">'.$data['content'].'</p>
            </div>
            <div class="col-md-5">
              <a href = parcours.php?id='.$donnees['id'].'>
              <img class="img-fluid d-block" src="'.$donnees['picture'].'"> </div>
              </a>
          </div>
        </div>
      </div>';
    }
      else{
    echo '
    <div class="py-5">
      <div class="container">
        <div class="row">
        <div class="col-md-5 order-2 order-md-1">
          <a href = parcours.php?id='.$donnees['id'].'>
            <img class="img-fluid d-block" src="'.$donnees['picture'].'"> </div>
          </a>
          <div class="col-md-7 order-1 order-md-2">
          <a href = parcours.php?id='.$donnees['id'].'>
              <h3>'.$donnees['title'].'</h3>
            </a>
            <p class="my-3">'.$data['content'].'</p>
            </div>
        </div>
      </div>
    </div>';
  }
    $count = $count + 1;
      ?>

   <?php
 }
   }
  }
  else{
    header("Location: index.php");
    exit;
  }

   ?>
