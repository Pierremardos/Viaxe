<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Viaxe</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
  <body>
  	<header>
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
  	</header>

    <main>
      <div class="inscription container">
  		<form action="verifInscriptionGuide.php" method="post">
  			<input type="text" name="pseudo" placeholder="Pseudo"><br>
  			<input type="text" name="email" placeholder="Email"><br>
        <input type="text" name="prenom" placeholder="prenom"><br>
        <input type="text" name="nom" placeholder="nom"><br>
  			<input type="password" name="password" placeholder="Mot de passe"><br>
				<input type="password" name="confirm" placeholder="Confirmer"><br>
  			<input type="date" name="birthday" placeholder="Date de naissance"><br><br>
  			<input type="radio" name="gender" value="1" checked> Homme
  			<input type="radio" name="gender" value="2"> Femme<br><br>
  			<select name="country">
					<option selected>Pays</option>
  				<option value="fr">France</option>
  				<option value="en">Angleterre</option>
  				<option value="sp">Espagne</option>
  				<option value="ge">Allemagne</option>
  			</select><br>
        <select name="langue">
					<option selected>Langue</option>
  				<option value="fr">French</option>
  				<option value="en">English</option>
  				<option value="sp">Espagne</option>
  				<option value="ge">Allemagne</option>
  			</select><br>
				Optionnel :
				<br>
				Numéro de téléphone : <input type="text" name="telephone">
        <br>
        Description : <input type="text" name="description">
        <br>
        Avez-vous un diplôme de guide de tourisme ( si oui, vérification nécessaire) :
        <input type="radio" name="diploma" value="1">Oui
        <input type="radio" name="diploma" value="2" checked>Non
        <input type="submit" value="Inscription">
      </div>
  	</main>
  </body>

</html>
