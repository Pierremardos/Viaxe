<!DOCTYPE html>
<html>
<head>
	<title>Viaxe</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/newstyle.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 	<script src="include/index.js"></script>
</head>
<body>
	<header>
		<?php
		include('Navbar.php')
		?>
	</header>
	<main>
		<section>
			<h1>Qu'est ce que Viaxe ?<h1>
				<p>
					 Viaxe est un site de recherche de parcours avec des thèmes plus ou moins variés. Les guides qui sont indépendants de nous,
					 vont poster des parcours aux 4 coins de notre globe pour vous aider à le découvrir et le comprendre.
					 Notre rôle est de vous présenter ces parcours afin que vous puissez trouver celui qui correspond le plus à vos attentes.
					 Bienvenue et bonne recherche.
				</p>
		</section>
		<div class="search container">
			<form action="searchparcours.php" method="post">
				Je recherche : <input type="radio" name="type" value="parcours" checked> Parcours
				<input type="radio" name="type" value="guide"> Guide
				<br>
				<br>
				<input type="search" name="city" placeholder="Search...">
				<br>
				<br>
				<p>
  				Prix:
					<br>
  				<input type="text" id="amount1" readonly style="border:0; color:#00B2B1; font-weight:bold;">
				</p>
				<div id="slider-range"></div>
				<br>
				<p>
					Nombre de places :
  				<input type="text" id="amount" readonly style="border:0; color:#00B2B1; font-weight:bold;">
				</p>
				<div id="slider-range-min"></div>
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
				<input type="submit" value="Recherche" readonly style="margin-left: 1030px;">
			</form>
		</div>
		<br>
		<h1 class="titreSection">Les parcours de la journée</h1>
		<div class="search container">
  		<div class="row container">
   			<div class="col-md-4">
     			<div class="thumbnail">
         		<a href="#"><img src="images/GalerieEvo.jpg" alt="GalerieEvolution" style="width:100%">
         			<div class="caption">
           			<p>Lorem ipsum...</p>
         			</div>
       			</a>
     			</div>
   			</div>
   			<div class="col-md-4">
     			<div class="thumbnail">
         		<a href="#"><img src="images/PyramidesCaire.jpg" alt="Pyramides" style="width:100%">
         			<div class="caption">
           			<p>Lorem ipsum...</p>
         			</div>
       			</a>
     			</div>
   			</div>
   			<div class="col-md-4">
     			<div class="thumbnail">
         		<a href="#"><img src="images/Sydney.jpg" alt="Sydney" style="width:100%">
         			<div class="caption">
           			<p>Lorem ipsum...</p>
         			</div>
       			</a>
      		</div>
    		</div>
    	</div>
		</div>
		<br>
		<h1 class="titreSection">Côté Cuisine</h1>
		<div class="search container">
			<div class="row container">
				<div class="col-md-4">
					<div class="thumbnail">
						<a href="#"> <img src="images/chinois.jpg" alt="Restaurant Paris" style="width:100%">
							<div class="caption">
								<p>Lorem ipsum...</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<a href="#"><img src="images/orchestre.jpg" alt="Restaurant Orchestre" style="width:100%">
							<div class="caption">
								<p>Lorem ipsum...</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<a href="#"><img src="images/jack.jpg" alt="Blue Lagoon" style="width:100%">
							<div class="caption">
								<p>Lorem ipsum...</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<br>
		<h1 class="titreSection">Nos coups de coeur</h1>
		<div class="search container">
			<div class="row container">
				<div class="col-md-4">
					<div class="thumbnail">
						<a href="#"><img src="images/Guimet.jpg" alt="Coup de coeur 1" style="width:100%">
							<div class="caption">
								<p>Lorem ipsum...</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<a href="#"><img src="images/TourEiffel.jpg" alt="Coup de coeur 2" style="width:100%">
							<div class="caption">
								<p>Lorem ipsum...</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<a href="#"><img src="images/Buddha.jpg" alt="Laos Buddah Park" style="width:100%">
							<div class="caption">
								<p>Lorem ipsum...</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>
</html>
