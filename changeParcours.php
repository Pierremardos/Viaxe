<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();

$req=$bdd->prepare('SELECT *
FROM TRIP WHERE id = :id');
$req->bindValue(':id',$_GET['id'], PDO::PARAM_STR);
$req->execute();
$donnees=$req->fetch();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/map.css">
    <title>Créer un parcours</title>
  </head>
    <body>
    <header>
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

      echo'
    </header>
    <main>
      <div class="py-5">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-8 offset-md-4">
            <form action="renewParcours.php?id='.$donnees['id'].'" method="post" enctype="multipart/form-data">
                <div class="form-group w-50">
    							<label>Titre :</label>
                  <input type="text" class="form-control" name="title" value="'.$donnees['title'].'">
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Date du parcours :</label>
    							<input type="date" name="date"/>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-10">
    							<label>Heure de départ :</label>
                  <input type="text" name="departHour">h
                  <input type="text" name="departMin">min
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-10">
    							<label>Durée du parcours :</label>
                  <input type="text" name="durationHour">h
                  <input type="text" name="durationMin">min
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Langues utilisés :</label>
                  <input type="text" name="language" value="'.$donnees['languages'].'"/>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Prix par client :</label>
                  <input type="text" name="price" value="'.$donnees['price'].'"/>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
                  <label>Places disponibles :</label>
                  <input type="text" name="place" value="'.$donnees['places'].'"/>
                  <small class="form-text text-muted"></small>
                </div>
      <p>
      Une réduction peut être appliqué à partir d une certaine date afin de remplir les places vacantes du parcours.
      Si cela ne vous interesse pas laissez les champs vides.
      </p>
      <div class="form-group w-50">
        <label>Date et heure d application de la réduction :</label>
        <input type="date" name="finalDate"/>
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-10">
        <label>Heure d application de la réduction :</label>
        <input type="text" name="finalHour">h
        <input type="text" name="finalMin">min
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-10">
        <label>Prix appliqué à la réduction :</label>
        <input type="text" name="finalPrice">
        <small class="form-text text-muted"></small>
      </div>
      <input type="submit" value="Renouveler">
    </form>
  </main>
  </body>
</html>';
?>
