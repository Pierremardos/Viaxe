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
 $picture = "/Viaxe/images/".$id . ".jpeg";

 $dossier = 'images/';
 		$fichier = basename($_FILES['avatar']['name']);
 		$taille_maxi = 100000;
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
        rename($dossier . $fichier, $dossier . $id . ".jpeg");
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
 $duration = $_POST['duration'];
 $city = $_POST['city'];
 $country = $_POST['country'];
 $language = $_POST['language'];
 $price = $_POST['price'];
 $category = $_POST['categorie'];
 $places = $_POST['place'];
 $finalPrice = $_POST['finalPrice'];
 $content = $_POST['content'];
 $mail = $_SESSION['mail'];

 $req = $bdd->prepare('INSERT INTO TRIP (title, date, picture, duration, country, city, languages, price, finalPrice,datePrice,category,places,content,mailGuide)
  VALUES ( :title, NOW(), :picture, :duration, :country, :city, :language, :price, :finalPrice, NOW(), :category, :places, :content, :mailGuide)');


 $req->execute(array(
   "title"=>$title,
   "picture"=>$picture,
   "duration"=>$duration,
   "city"=>$city,
   "country"=>$country,
   "language"=>$language,
   "price"=>$price,
   "finalPrice"=>$finalPrice,
   "category"=>$category,
   "places"=>$places,
   "content"=>$content,
   "mailGuide"=>$mail
   ));



 header("location: index.php");
