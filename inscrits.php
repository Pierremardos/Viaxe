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
		     header("location: index.php");
         exit;
		   }
		}
		else{
      header("location: index.php");
      exit;
		}
	?>
  <?php
  $id = $_GET['id'];
  $rep=$bdd->prepare('SELECT *
  FROM PARTICIPANT WHERE idTrip = :id');
  $rep->bindValue(':id',$id, PDO::PARAM_STR);
  $rep->execute();
  while($data=$rep->fetch()){
    $query=$bdd->prepare('SELECT *
    FROM CUSTOMER WHERE mail = :mail');
    $query->bindValue(':mail',$data['mailCustomer'], PDO::PARAM_STR);
    $query->execute();
    $donnees=$query->fetch();
    echo '<div class="py-5">
   <div class="container">
     <div class="row">
       <div class="col-md-2 order-2 order-md-1">
         <a href="seeProfil.php?id='.$donnees['id'].'&role=c">
         <img class="img-fluid d-block" src="'.$donnees['picture'].'" width="150px"> </div>
       <div class="col-md-7 order-1 order-md-2">
         <h3>'.$donnees['pseudo'].' </a> <br> Nombre de places réservés : '.$data['numberCustomer'].'
           <br>
         </h3>
         <p class="">'.$data['time'].'</p>
       </div>
     </div>
   </div>
 </div>';

  }
