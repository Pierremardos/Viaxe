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

    $dossier = 'images/parcours/couv/';
    $dossier1 = 'images/parcours/descrip/';
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



    $fichier = basename($_FILES['avatar1']['name']);
 		$taille_maxi = 100000;
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
 		$taille_maxi = 100000;
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
 		$taille_maxi = 100000;
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
 $duration = ($_POST['durationHour']*60) + $_POST['durationMin'];
 $city = $_POST['city'];
 $country = $_POST['country'];
 $language = $_POST['language'];
 $price = $_POST['price'];
 $category = $_POST['categorie'];
 $places = $_POST['place'];
 $finalPrice = $_POST['finalPrice'];
 $content = $_POST['content'];
 $mail = $_SESSION['mail'];
// $date = $_SESSION['day'] + $_SESSION['month'] + $_SESSION['year'];
// $finalDate = $_SESSION['finalDay'] + $_SESSION['finalMonth'] + $_SESSION['finalYear'];

 $req = $bdd->prepare('INSERT INTO TRIP (title, date, picture, duration, country, city, languages, price, finalPrice,datePrice,category,places,content,contentPic1,contentPic2,contentPic3,mailGuide)
  VALUES ( :title, NOW(), :picture, :duration, :country, :city, :language, :price, :finalPrice, NOW(), :category, :places, :content, :pic1, :pic2, :pic3, :mailGuide)');


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
   "pic1"=>$pic1,
   "pic2"=>$pic2,
   "pic3"=>$pic3,
   "mailGuide"=>$mail
   ));



 header("location: index.php");
