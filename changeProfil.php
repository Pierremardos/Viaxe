<?php
session_start();
include 'include/config.php';
include 'include/functions.php';

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

   $pseudo = $_POST['newPseudo'];
   $phone = $_POST['newPhone'];
   $picture = ;
   $content = $_POST['newContent'];
   $password = $_POST['newPassword'];
   $confirm = $_POST['confirmNewPassword'];

   $req = $bdd->prepare('UPDATE GUIDE SET pseudo=:pseudo, phone=:phone, description=:content,
     password=:password WHERE mail=:mail');


   $req->execute(array(
     "pseudo"=>$pseudo,
     "phone"=>$phone,
     "content"=>$content,
     "password"=>$password,
     "mail"=>$_SESSION['mail']
     ));

     header('Location:index.php');
