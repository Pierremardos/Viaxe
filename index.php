<!DOCTYPE html>
<html>
<head>
	<title>Viaxe</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<header>
		<?php include('Navbar.php')
		?>
	</header>

	<main>
		<div class="search container">
			<form action="searchparcours" method="post">
				<div class="searchp1">
					<input type="range" name="minprice">
					<input type="range" name="maxprice">
					<input type="range" name="place">
					<input type="date" name="date">
					<input type="search" name="search" placeholder="Search...">
				</div>
				<div class="searchp2">
						<select name="categorie">
							<option value="culturel" selected>Culturel</option>
							<option value="food">Culinaire</option>
							<option value="fun">Ludique</option>
						</select>
						<select name="langage">
							<option value="undefined">Indefini</option>
							<option value="fr">Francais</option>
						</select>
						<select name="langage2">
							<option value="undefined">Indefini</option>
							<option value="fr">Francais</option>
						</select>
						<input type="submit" value="Recherche">
				</div>
			</form>
		</div>
		<div class="search container">

		</div>
	</main>
	</body>
	</html>
