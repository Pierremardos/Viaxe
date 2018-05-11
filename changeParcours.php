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

      $id = $_GET['id'];
		  $query=$bdd->prepare('SELECT *
		  FROM TRIP WHERE id = :id');
		  $query->bindValue(':id',$id, PDO::PARAM_STR);
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
	?>
<?php
echo'
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-4">
              <form action="renewParcours.php?id='.$id.'" method="post">
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
              <div class="form-group w-50">
                <label>Langues utilisés :</label>
                <input type="text" name="language"/>
                <small class="form-text text-muted"></small>
              </div>
              <div class="form-group w-50">
                <label>Prix par client :</label>
                <input type="text" name="price"/>
                <small class="form-text text-muted"></small>
              </div>
              <div class="form-group w-50">
                <label>Places disponibles :</label>
                <input type="text" name="place"/>
                <small class="form-text text-muted"></small>
              </div>
              <p>
              Une réduction peut être appliqué à partir d une certaine date afin de remplir les places vacantes du parcours.
              Si cela ne vous interesse pas laissez les champs vides.
              </p>
              <div class="form-group w-25">
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
              </form>';
