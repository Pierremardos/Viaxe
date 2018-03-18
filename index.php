<!DOCTYPE html>
<html>
<head>
	<title>Viaxe</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		var slider = document.getElementById("myRange");
		var output = document.getElementById("demo");
		output.innerHTML = slider.value;
		slider.oninput = function() {
  	output.innerHTML = this.value;
}
</script>
</head>
<body>
	<header>
		<?php include('Navbar.php')
		?>
	</header>
	<main>
		<div class="search container">
			<form action="searchparcours" method="post">
					Je recherche : <input type="radio" name="type" value="parcours" checked> Parcours
					<input type="radio" name="type" value="people"> Utilisateur
					<br>
					<div class="""slidecontainer">
					<input type="range" name="minprice" class="slider" id="MyRange">
					<p>Value: <span id="demo"></span></p>
					<input type="range" name="maxprice">
					<input type="range" name="place">
					</div>
					<div class="""slidecontainer">
  <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
  <p>Value: <span id="demo"></span></p>
</div>
					<input type="date" name="date">
					<input type="search" name="search" placeholder="Search...">
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
