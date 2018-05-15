<?php
  session_start();
  include 'include/config.php';
  include 'include/functions.php';
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

 $query = $bdd ->prepare('SELECT MAX(id) FROM TRIP;');
 $query->execute();
 $donnees = $query->fetch();
 $id = $donnees['0'];
 $id = $id + 1;
 $picture = "/Viaxe/images/parcours/couv/".$id . ".jpeg";
 $pic1 = "/Viaxe/images/parcours/descrip/".$id . "a.jpeg";
 $pic2 = "/Viaxe/images/parcours/descrip/".$id . "b.jpeg";
 $pic3 = "/Viaxe/images/parcours/descrip/".$id . "c.jpeg";
 $error = 0;
 $accept = 0;
 $_SESSION['false'] = "ok";

    $dossier = 'images/parcours/couv/';
    $dossier1 = 'images/parcours/descrip/';
 		$fichier = basename($_FILES['avatar']['name']);
 		$taille_maxi = 300000;
 		$taille = filesize($_FILES['avatar']['tmp_name']);
 		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
 		$extension = strrchr($_FILES['avatar']['name'], '.');

 		//Début des vérifications de sécurité...
 		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
 		{
        $picture = "/Viaxe/images/parcours/couv/unknow.jpg";
 		}
 		if($taille>$taille_maxi)
 		{
 			$erreur = 'Le fichier est trop gros...';
 		}
 		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
 		{
 			//formatage du nom (suppression des accents, remplacements des espaces par "-")
 			$fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
 			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
 			if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //correct si la fonction renvoie TRUE
 			{
 				echo 'Upload effectué avec succès !';
        rename($dossier . $fichier, $dossier . $id . ".jpeg");
 				//ajout_image($fichier,);
 			}
 			else //sinon, cas où la fonction renvoie FALSE
 			{
        $picture = "/Viaxe/images/parcours/couv/unknow.jpg";
 		    }
 		}
 		else
 		{
 			echo $erreur;
      $picture = "/Viaxe/images/parcours/couv/unknow.jpg";
 		}


    if(!empty($_FILES['avatar1']['name'])){
    $fichier = basename($_FILES['avatar1']['name']);
 		$taille_maxi = 300000;
 		$taille = filesize($_FILES['avatar1']['tmp_name']);
 		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
 		$extension = strrchr($_FILES['avatar1']['name'], '.');

 		//Début des vérifications de sécurité...
 		if($taille>$taille_maxi)
 		{
 			$erreur = 'Le fichier est trop gros...';
 		}
 		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
 		{
 			//formatage du nom (suppression des accents, remplacements des espaces par "-")
 			$fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
 			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
 			if(move_uploaded_file($_FILES['avatar1']['tmp_name'], $dossier1 . $fichier)) //correct si la fonction renvoie TRUE
 			{
 				echo 'Upload effectué avec succès !';
        rename($dossier1 . $fichier, $dossier1 . $id . "a.jpeg");
 				//ajout_image($fichier,);
 			}
 			else //sinon, cas où la fonction renvoie FALSE
 			{

 		  }
 		}
 		else
 		{
 			echo $erreur;
 		}
  }
  else{
    $pic1 ="";
  }

    if(!empty($_FILES['avatar2']['name'])){
    $fichier = basename($_FILES['avatar2']['name']);
 		$taille_maxi = 300000;
 		$taille = filesize($_FILES['avatar2']['tmp_name']);
 		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
 		$extension = strrchr($_FILES['avatar2']['name'], '.');

 		if($taille>$taille_maxi)
 		{
 			$erreur = 'Le fichier est trop gros...';
 		}
 		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
 		{
 			//formatage du nom (suppression des accents, remplacements des espaces par "-")
 			$fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
 			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
 			if(move_uploaded_file($_FILES['avatar2']['tmp_name'], $dossier1 . $fichier)) //correct si la fonction renvoie TRUE
 			{
 				echo 'Upload effectué avec succès !';
        rename($dossier1 . $fichier, $dossier1 . $id . "b.jpeg");
 				//ajout_image($fichier,);
 			}
 			if(isset($fichier) & !empty($fichier)) //sinon, cas où la fonction renvoie FALSE
 			{
 				echo 'Echec de l\'upload !';
 		    }
 		}
 		else
 		{
 			echo $erreur;
 		}
  }
  else{
    $pic2 = "";
  }


    if(!empty($_FILES['avatar3']['name'])){
    $fichier = basename($_FILES['avatar3']['name']);
 		$taille_maxi = 300000;
 		$taille = filesize($_FILES['avatar3']['tmp_name']);
 		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
 		$extension = strrchr($_FILES['avatar3']['name'], '.');

 		//Début des vérifications de sécurité...
 		if($taille>$taille_maxi)
 		{
 			$erreur = 'Le fichier est trop gros...';
 		}
 		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
 		{
 			//formatage du nom (suppression des accents, remplacements des espaces par "-")
 			$fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
 			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
 			if(move_uploaded_file($_FILES['avatar3']['tmp_name'], $dossier1 . $fichier)) //correct si la fonction renvoie TRUE
 			{
 				echo 'Upload effectué avec succès !';
        rename($dossier1 . $fichier, $dossier1 . $id . "c.jpeg");
 				//ajout_image($fichier,);
 			}
 		}
 		else
 		{
 			echo $erreur;
 		}
  }
  else{
    $pic3 = "";
  }


 $title = htmlspecialchars($_POST['title']);
 if(!isset($title) | empty($title)){
   $error++;
   echo "Le titre n'a pas été rentré<br>";
 }
 else{
   $_SESSION['titleTrip'] = $title;
 }

 if(!isset($_POST['date']) | empty($_POST['date'])){
    echo "La date de départ n'a pas été rentré<br>";
 }
 if($_POST['departHour'] > 23 | $_POST['departHour'] < 0){
     echo "Le format de l'heure de départ n'est pas valide<br>";
 }
 else if(!isset($_POST['departHour']) | empty($_POST['departHour'])){
   $_POST['departHour'] = 0;
 }
 else{
   $_SESSION['departHourTrip'] = $_POST['departHour'];
 }
 if($_POST['departMin'] > 59 | $_POST['departMin'] < 0){
   echo "Le format des minutes de l'heure de départ n'a pas été rentré<br>";
 }
 else if(!isset($_POST['departMin']) | empty($_POST['departMin'])){
   $_POST['departMin'] = 0;
 }
 else{
   $_SESSION['departMinTrip'] = $_POST['departMin'];
 }

 $date = $_POST['date'] . " " . htmlspecialchars($_POST['departHour']) . ":" . htmlspecialchars($_POST['departMin']) . ":00";
 $duration = ($_POST['durationHour']*60) + $_POST['durationMin'];

 $city = htmlspecialchars($_POST['city']);
 if(!isset($city) | empty($city)){
   echo "La ville n'a pas été rentré<br>";
 }
 else{
   $_SESSION['cityTrip'] = $city;
 }

 $country = $_POST['country'];
 if(!isset($country) | empty($country)){
   echo "Le pays n'a pas été rentré<br>";
 }
 else{
   $_SESSION['countryTrip'] = $country;
 }

 $language = htmlspecialchars($_POST['language']);
 if(!isset($language) | empty($language)){
   echo "Les langues maîtrisés n'ont pas été rentré<br>";
 }
 else{
   $_SESSION['languageTrip'] = $language;
 }

 $price = htmlspecialchars($_POST['price']);
 if(!isset($price) | empty($price)){
   $error++;
   echo "Le prix n'a pas été rentré<br>";
 }
 else if($price > 500){
   $error++;
   echo "Le prix doit être inférieur à 500<br>";
 }
 else{
   $_SESSION['priceTrip'] = $price;
 }

 $category = $_GET['type'];
 if($category == 2){
   $category = 'Culinaire';
 }
 else if($category == 1){
   $category = 'Culturel';
 }
 else{
   echo "Erreur de type dans l'url";
   $error++;
 }

 $places = htmlspecialchars($_POST['place']);
 if(!isset($places) | empty($places)){
   $error++;
   echo "Le nombre de places n'a pas été rentré<br>";
 }
 else{
   $_SESSION['placesTrip'] = $places;
 }

 $finalPrice = htmlspecialchars($_POST['finalPrice']);
 $_SESSION['oldNow'] = $now = strtotime("now") + 7200;
 $mail = $_SESSION['mail'];

 $map = $_POST['map'];
 if(!isset($map) | empty($map)){
   $map = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.474236839812!2d2.3875456156740595!3d48.8491665792866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6720d9c7af387%3A0x5891d8d62e8535c7!2sESGI%2C+%C3%89cole+Sup%C3%A9rieure+de+G%C3%A9nie+Informatique!5e0!3m2!1sfr!2sfr!4v1525684658911" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
 }
 else{
   $_SESSION['mapTrip'] = $map;
 }

 if($finalPrice < 0){
   $error++;
    echo "Le prix de la réduction doit être positif<br>";
 }

 $max = strtotime($date);
 if($max - $now < 36000 | $max - $now > 2678400){
   $error++;
   echo "La date du parcours est inférieur à la date actuelle ou trop loin dans la temps<br>";
 }
 if(!isset($max) | empty($max)){
   $error++;
   echo "La date du parcours n'a pas été rentrée <br>";
 }

 if($finalPrice != 0 | $_POST['finalHour'] != 0 | $_POST['finalMin'] != 0){
   if(!isset($finalPrice) | !isset($_POST['finalDate']) | empty($_POST['finalDate'])){
     $error++;
      echo "Le prix ou la date de la réduction n'a pas été rentré<br>";
   }
   if($_POST['finalHour'] > 23 | $_POST['finalHour'] < 0){
     $error++;
      echo "Le format de l'heure de réduction n'est pas valide<br>";
   }
   else if(!isset($_POST['finalHour']) | empty($_POST['finalHour'])){
     $_POST['finalHour'] = 0;
   }
   if($_POST['finalMin'] > 59 | $_POST['finalMin'] < 0){
     $error++;
     echo "Le format des minutes pour l'heure de réduction n'est pas valide<br>";
   }
   else if(!isset($_POST['finalMin']) | empty($_POST['finalMin'])){
     $_POST['finalMin'] = 0;
   }
 }
 else{
   if($error == 0){
   $req = $bdd->prepare('INSERT INTO TRIP (title, map, date, picture, duration, country, city, languages, price, finalPrice, datePrice, category,places,mark,mailGuide)
    VALUES ( :title, :map, :dateDep, :picture, :duration, :country, :city, :language, :price, :finalPrice, :datePrice, :category, :places, 0, :mailGuide)');


   $req->execute(array(
     "title"=>$title,
     "map"=>$map,
     "dateDep"=>$date,
     "picture"=>$picture,
     "duration"=>$duration,
     "city"=>$city,
     "country"=>$country,
     "language"=>$language,
     "price"=>$price,
     "finalPrice"=>$price,
     "datePrice"=>$date,
     "category"=>$category,
     "places"=>$places,
     "mailGuide"=>$mail
     ));
     $accept = 1;
 }
}
 $finalDate = $_POST['finalDate'] . " " . htmlspecialchars($_POST['finalHour']) . ":" . htmlspecialchars($_POST['finalMin']) . ":00";

if(isset($date) | !empty($date)){

 $reduc = strtotime($finalDate);

 if(isset($reduc) | !empty($reduc)){
 if($max < $reduc){
    $error++;
     echo "La date de réduction s'applique après le parcours<br>";
 }
}
}

if($accept == 0 & $error == 0){
 $req = $bdd->prepare('INSERT INTO TRIP (title, map, date, picture, duration, country, city, languages, price, finalPrice,datePrice,category,places, mailGuide)
  VALUES ( :title, :map, :dateDep, :picture, :duration, :country, :city, :language, :price, :finalPrice, :finalDate, :category, :places, :mailGuide)');


 $req->execute(array(
   "title"=>$title,
   "map"=>$map,
   "dateDep"=>$date,
   "picture"=>$picture,
   "duration"=>$duration,
   "city"=>$city,
   "country"=>$country,
   "language"=>$language,
   "price"=>$price,
   "finalPrice"=>$finalPrice,
   "finalDate"=>$finalDate,
   "category"=>$category,
   "places"=>$places,
   "mailGuide"=>$mail
   ));
 }

if($error == 0){
   $content = htmlspecialchars($_POST['content']);
   $content2 = htmlspecialchars($_POST['content2']);
   $content3 = htmlspecialchars($_POST['content3']);

   $req = $bdd->prepare('INSERT INTO CONTENT (Picture, content, idTrip)
    VALUES ( :pic, :content, :id)');


   $req->execute(array(
     "pic"=>$pic1,
     "content"=>$content,
     "id"=>$id
     ));

     $rep = $bdd->prepare('INSERT INTO CONTENT (Picture, content, idTrip)
      VALUES ( :pic, :content, :id)');


     $rep->execute(array(
       "pic"=>$pic2,
       "content"=>$content2,
       "id"=>$id
       ));

       $query = $bdd->prepare('INSERT INTO CONTENT (Picture, content, idTrip)
        VALUES ( :pic, :content, :id)');


       $query->execute(array(
         "pic"=>$pic3,
         "content"=>$content3,
         "id"=>$id
         ));
   }

 if($error == 0){
    $_SESSION['titleTrip'] = "";
    $_SESSION['departHourTrip'] = "";
    $_SESSION['departMinTrip'] = "";
    $_SESSION['countryTrip'] = "";
    $_SESSION['cityTrip'] = "";
    $_SESSION['languageTrip'] = "";
    $_SESSION['priceTrip'] = "";
    $_SESSION['placesTrip'] = "";
    $_SESSION['false'] = "good";
    header("location: index.php");
    exit;
}

 echo'<a href="createParcours.php?type='.$_GET["type"].'"> Continuer la création </a>';
