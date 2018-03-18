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
  		<?php include('Navbar.php')?>
  	</header>

    <main>
      <div class="inscription container">
  		<form action="verificationinscription.php" method="post">
  			<input type="text" name="pseudo" placeholder="Pseudo"><br>
  			<input type="text" name="email" placeholder="Email"><br>
  			<input type="password" name="password" placeholder="Mot de passe"><br>
				<input type="password" name="confirm" placeholder="Confirmer"><br>
  			<input type="date" name="birthday" placeholder="Date de naissance"><br><br>
  			<input type="radio" name="gender" value="1" checked> Homme
  			<input type="radio" name="gender" value="2"> Femme<br><br>
        <select name="role">
					<option selected>Rôle</option>
          <option value="utilisateur">Utilisateur</option>
          <option value="guide">Guide</option>
        </select> <br> <br>
  			<select name="country">
					<option selected>Pays</option>
  				<option value="fr">France</option>
  				<option value="en">Angleterre</option>
  				<option value="sp">Espagne</option>
  				<option value="ge">Allemagne</option>
  			</select><br>
  			<input type="submit" value="Inscription">
      </div>
  	</main>
  </body>

</html>
