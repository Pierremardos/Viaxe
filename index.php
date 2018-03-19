<!DOCTYPE html>
<html>
<head>
	<title>Viaxe</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
 $( function() {
	 $( "#slider-range" ).slider({
		 range: true,
		 min: 0,
		 max: 500,
		 values: [ 100, 300 ],
		 slide: function( event, ui ) {
			 $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		 }
	 });
	 $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
		 " - $" + $( "#slider-range" ).slider( "values", 1 ) );
 } );
 </script>
 <script>
 $( function() {
	 $( "#slider-range-min" ).slider({
		 range: "min",
		 value: 1,
		 min: 1,
		 max: 10,
		 slide: function( event, ui ) {
			 $( "#amount" ).val( "$" + ui.value );
		 }
	 });
	 $( "#amount" ).val( "$" + $( "#slider-range-min" ).slider( "value" ) );
 } );
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
					<br>
					<p>
  				Prix:
					<br>
  				<input type="text" id="amount" readonly style="border:0; color:#00B2B1; font-weight:bold;">
					</p>
					<div id="slider-range"></div>
					<br>
					<p>
					Nombre de places :
  				<input type="text" id="amount" readonly style="border:0; color:#00B2B1; font-weight:bold;">
					</p>

<div id="slider-range-min"></div>
					<br>
					<br>
					Date :
					<input type="date" name="date">
					Categorie :
						<select name="categorie">
							<option value="culturel" selected>Culturel</option>
							<option value="food">Culinaire</option>
							<option value="fun">Ludique</option>
						</select>
						Langue 1 :
						<select name="langage">
							<option value="undefined">Indefini</option>
							<option value="fr">Francais</option>
						</select>
						Langue 2 :
						<select name="langage2">
							<option value="undefined">Indefini</option>
							<option value="fr">Francais</option>
						</select>
						<br>
						<br>
						<input type="search" name="search" placeholder="Search...">
						<input type="submit" value="Recherche">
				</div>
			</form>
		</div>
		<div class="search container">
		</div>
	</main>
	</body>
	</html>
