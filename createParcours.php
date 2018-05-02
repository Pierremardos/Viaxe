<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
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
      if($_GET['type']== 1 & $data['diploma'] != "ok"){
        header("location: chooseParcours.php");
        exit;
      }
  		?>
    </header>
    <main>
      <iframe class="container map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.474051746146!2d2.387545615079497!3d48.8491701093109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6720d9c7af387%3A0x5891d8d62e8535c7!2sEcole+Sup%C3%A9rieure+de+G%C3%A9nie+Informatique!5e0!3m2!1sfr!2sfr!4v1525080535212" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
      <div class="py-5">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-8 offset-md-4">
              <?php if($_GET['type']== 2){
    				echo'<form action="verifParcours.php?type=2" method="post" enctype="multipart/form-data">';
          }
            ?>
            <?php if($_GET['type']== 1){
              echo'<form action="verifParcours.php?type=1" method="post" enctype="multipart/form-data">';
            }
              ?>
    						<div class="form-group w-50">
                  <p>Pour copier le chemin de votre parcours <br>1-Sur la map cliquez en haut à gauche sur "Agrandir le plan"
                  <br>2-Cliquez sur itinéraire à gauche de la page, et mettre son chemin (il est possible de rajouter des destionations avec le petit + en bas des itinéraires)
                  <br>3-Appuyez sur le menu tout en haut à gauche et cliquez sur partagez ou intégrez la carte
                  <br>4-Aller sur intégrer une carte copier le code et le coller dans Insérer le lien</p>
    							<label>Insérer le lien :</label>
    							<input type="text" class="form-control" name="map">
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Titre :</label>
    							<input type="text" class="form-control" name="title">
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Photo de couverture du parcours :</label>
                  <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
                  <input type='file' name='avatar'>
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
    							<label>Pays du parcours :</label>
    							<input type="text" name="country"/>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Ville du parcours :</label>
    							<input type="text" name="city"/>
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
      Une réduction peut être appliqué à partir d'une certaine date afin de remplir les places vacantes du parcours.
      Si cela ne vous interesse laissez les champs vides.
      </p>
      <div class="form-group w-50">
        <label>Date et heure d'application de la réduction :</label>
        <input type="date" name="finalDate"/>
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-10">
        <label>Heure d'application de la réduction :</label>
        <input type="text" name="finalHour">h
        <input type="text" name="finalMin">min
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-10">
        <label>Prix appliqué à la réduction :</label>
        <input type="text" name="finalPrice">
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Photo 1 de la description du parcours :</label>
        <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
        <input type='file' name='avatar1'>
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Présentation associé à la photo :</label>
        <input type="text" name="content">
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Photo 2 de la description du parcours :</label>
        <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
        <input type='file' name='avatar2'>
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Présentation associé à la photo :</label>
        <input type="text" name="content2">
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Photo 3 de la description du parcours :</label>
        <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
        <input type='file' name='avatar3'>
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Présentation associé à la photo :</label>
        <input type="text" name="content3">
        <small class="form-text text-muted"></small>
      </div>
      <?php
      $_SESSION['type'] = $_GET['type'];
        ?>
      <input type="submit" value="Créer">
    </form>
  </main>
  </body>
</html>
