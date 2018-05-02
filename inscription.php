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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
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
			<div class="py-5">
		    <div class="container">
		      <div class="row">
		        <div class="col-md-8 offset-md-4">
		          <form method="post" action="verifInscriptionCustomer.php">
		            <div class="form-group w-50">
		              <label>Adresse Mail :</label>
		              <input type="mail" class="form-control" name="email">
		              <small class="form-text text-muted"></small>
		            </div>
								<div class="form-group">
								 <label>Pseudo :</label>
								 <input type="text" class="form-control w-50" name="pseudo">
							 </div>
		            <div class="form-group">
		              <label>Mot de Passe :</label>
		              <input type="password" class="form-control w-50" name="password">
		              </div>
								<div class="form-group">
								 <label>Confirmez votre mot de passe :</label>
								 <input type="password" class="form-control w-50" name="confirm">
							 </div>
							 <div class="form-group">
								<label>Date de naissance:</label>
								<input type="date" name="birthday" placeholder="Date de naissance">
							</div>
							<div class="form-group">
							 <label>Sexe :</label>
							 <input type="radio" name="gender" value="1" checked> Homme
			   			<input type="radio" name="gender" value="2"> Femme
						 </div>
						 <div class="form-group">
							 <label>Pays de résidence :</label>
							 <input type="text" class="form-control w-50" name="country">
						 </div>
						 <div class="form-group">
							 <label>Numéro de téléphone (Optionnel) :</label>
							 <input type="text" class="form-control w-50" name="telephone">
						 </div>
		            <button type="submit" class="btn btn-primary">Inscription</button>
		          </form>
		        </div>
		      </div>
		    </div>
		  </div>
  	</main>

	</body>
</html>
