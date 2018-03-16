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
		<?php include('Navbar.php')
		?>
	</header>

	<main>
		<div class="search container ">
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
	</main>
	</body>
	</html>
