<?php
  session_start();

 try
 {
   $bdd = new PDO('mysql:host=localhost;dbname=viaxe;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
 }
 catch(Exception $e)
 {
         die('Erreur : '.$e->getMessage());
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
 			$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
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
        rename($dossier . $fichier, $dossier . $id . "\0.jpeg");
 				//ajout_image($fichier,);
 			}
 			else //sinon, cas où la fonction renvoie FALSE
 			{
 				echo 'Echec de l\'upload !';
        $picture = "/Viaxe/images/parcours/couv/unknow.jpeg";
 		    }
 		}
 		else
 		{
 			echo $erreur;
      $picture = "/Viaxe/images/parcours/couv/unknow.jpeg";
 		}



    $fichier = basename($_FILES['avatar1']['name']);
 		$taille_maxi = 300000;
 		$taille = filesize($_FILES['avatar1']['tmp_name']);
 		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
 		$extension = strrchr($_FILES['avatar1']['name'], '.');

 		//Début des vérifications de sécurité...
 		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
 		{
 			$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
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
 			if(move_uploaded_file($_FILES['avatar1']['tmp_name'], $dossier1 . $fichier)) //correct si la fonction renvoie TRUE
 			{
 				echo 'Upload effectué avec succès !';
        rename($dossier1 . $fichier, $dossier1 . $id . "a.jpeg");
 				//ajout_image($fichier,);
 			}
 			else //sinon, cas où la fonction renvoie FALSE
 			{
 				echo 'Echec de l\'upload !';
 		    }
 		}
 		else
 		{
 			echo $erreur;
 		}

    $fichier = basename($_FILES['avatar2']['name']);
 		$taille_maxi = 300000;
 		$taille = filesize($_FILES['avatar2']['tmp_name']);
 		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
 		$extension = strrchr($_FILES['avatar2']['name'], '.');

 		//Début des vérifications de sécurité...
 		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
 		{
 			$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
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
 			if(move_uploaded_file($_FILES['avatar2']['tmp_name'], $dossier1 . $fichier)) //correct si la fonction renvoie TRUE
 			{
 				echo 'Upload effectué avec succès !';
        rename($dossier1 . $fichier, $dossier1 . $id . "b.jpeg");
 				//ajout_image($fichier,);
 			}
 			else //sinon, cas où la fonction renvoie FALSE
 			{
 				echo 'Echec de l\'upload !';
 		    }
 		}
 		else
 		{
 			echo $erreur;
 		}

    $fichier = basename($_FILES['avatar3']['name']);
 		$taille_maxi = 300000;
 		$taille = filesize($_FILES['avatar3']['tmp_name']);
 		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
 		$extension = strrchr($_FILES['avatar3']['name'], '.');

 		//Début des vérifications de sécurité...
 		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
 		{
 			$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
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
 			if(move_uploaded_file($_FILES['avatar3']['tmp_name'], $dossier1 . $fichier)) //correct si la fonction renvoie TRUE
 			{
 				echo 'Upload effectué avec succès !';
        rename($dossier1 . $fichier, $dossier1 . $id . "c.jpeg");
 				//ajout_image($fichier,);
 			}
 			else //sinon, cas où la fonction renvoie FALSE
 			{
 				echo 'Echec de l\'upload !';
 		    }
 		}
 		else
 		{
 			echo $erreur;
 		}


 $title = $_POST['title'];
 if(!isset($title) | empty($title)){
   $error++;
   $_SESSION['titleRed'] = 1;
 }
 else{
   $_SESSION['titleTrip'] = $title;
   $_SESSION['titleRed'] = 0;
 }

 if(!isset($_POST['date']) | empty($_POST['date'])){
   $error++;
 }
 if($_POST['departHour'] > 23 & $_POST['departHour'] < 0){
   $error++;
 }
 else if(!isset($_POST['departHour']) | empty($_POST['departHour'])){
   $_POST['departHour'] = 0;
 }
 else{
   $_SESSION['departHourTrip'] = $_POST['departHour'];
 }
 if($_POST['departMin'] > 59 & $_POST['departMin'] < 0){
   $error++;
 }
 else if(!isset($_POST['departMin']) | empty($_POST['departMin'])){
   $_POST['departMin'] = 0;
 }
 else{
   $_SESSION['departMinTrip'] = $_POST['departMin'];
 }
 $date = $_POST['date'] . " " . $_POST['departHour'] . ":" . $_POST['departMin'] . ":00";

 $duration = ($_POST['durationHour']*60) + $_POST['durationMin'];

 $city = $_POST['city'];
 if(!isset($city) | empty($city)){
   $error++;
 }
 else{
   $_SESSION['cityTrip'] = $city;
 }

 $country = $_POST['country'];
 if(!isset($country) | empty($country)){
   $error++;
 }
 else{
   $_SESSION['countryTrip'] = $country;
 }

 $language = $_POST['language'];
 if(!isset($language) | empty($language)){
   $error++;
 }
 else{
   $_SESSION['languageTrip'] = $language;
 }

 $price = $_POST['price'];
 if(!isset($price) | empty($price)){
   $error++;
 }
 else if($price > 500){
   $error++;
 }
 else{
   $_SESSION['priceTrip'] = $price;
 }

 $category = $_GET['type'];
 if($category == 2){
   $category = 'Culinaire';
 }
 else{
   $category = 'Culturel';
 }

 $places = $_POST['place'];
 if(!isset($places) | empty($places)){
   $error++;
 }
 else{
   $_SESSION['placesTrip'] = $places;
 }

 $finalPrice = $_POST['finalPrice'];

 if(isset($finalPrice) | isset($_POST['finalDate']) | isset($_POST['finalHour']) | isset($_POST['finalMin'])){
   if(!isset($finalPrice) & !isset($_POST['finalDate']) & empty($_POST['finalDate']) & !isset($_POST['finalHour']) & !isset($_POST['finalMin'])){
     $error++;
   }
   if($_POST['finalHour'] > 23 & $_POST['finalHour'] < 0){
     $error++;
   }
   else if(!isset($_POST['departHour']) | empty($_POST['departHour'])){
     $_POST['departHour'] = 0;
   }
   if($_POST['departMin'] > 59 & $_POST['departMin'] < 0){
     $error++;
   }
   else if(!isset($_POST['departMin']) | empty($_POST['departMin'])){
     $_POST['departMin'] = 0;
   }
 }
 else{
   if($error == 0){
   $req = $bdd->prepare('INSERT INTO TRIP (title, map, date, picture, duration, country, city, languages, price,category,places, mailGuide)
    VALUES ( :title, :map, :dateDep, :picture, :duration, :country, :city, :language, :price, :category, :places, :mailGuide)');


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
     "category"=>$category,
     "places"=>$places,
     "mailGuide"=>$mail
     ));
     $accept = 1;
 }
}
 $finalDate = $_POST['finalDate'] . " " . $_POST['finalHour'] . ":" . $_POST['finalMin'] . ":00";
 $mail = $_SESSION['mail'];

 $map = $_POST['map'];
 if(!isset($map) | empty($map)){
   $error++;
 }
 else{
   $_SESSION['mapTrip'] = $map;
 }

 $max = strtotime($date);
 $_SESSION['oldNow'] = $now = strtotime("now") + 7200;
 $reduc = strtotime($finalDate);

 if(isset($reduc) | !empty($reduc)){
 if($max < $reduc){
   $error++;
 }
}
 if($max - $now < 36000 | $max - $now > 2678400){
   $error++;
 }
 if(!isset($max) | empty($max)){
   $error++;
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

   $content = $_POST['content'];
   $content2 = $_POST['content2'];
   $content3 = $_POST['content3'];

   $req = $bdd->prepare('INSERT INTO CONTENT (Picture, content, idTrip)
    VALUES ( :pic, :content, :id)');


   $req->execute(array(
     "pic"=>$pic1,
     "content"=>$content,
     "id"=>$id
     ));

     $req = $bdd->prepare('INSERT INTO CONTENT (Picture, content, idTrip)
      VALUES ( :pic, :content, :id)');


     $req->execute(array(
       "pic"=>$pic2,
       "content"=>$content2,
       "id"=>$id
       ));

       $req = $bdd->prepare('INSERT INTO CONTENT (Picture, content, idTrip)
        VALUES ( :pic, :content, :id)');


       $req->execute(array(
         "pic"=>$pic3,
         "content"=>$content3,
         "id"=>$id
         ));

 if($error == 0){
    $_SESSION['false'] = "good";
    header("location: index.php");
    exit;
}
else{
  $_SESSION['false'] = "ok";
  header("location: createParcours.php?type=".$_GET['type']."");
  exit;
}
