<?php
session_start();
include 'include/config.php';
include 'include/functions.php';

$dossier = 'images/guide/';
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
       rename($dossier . $fichier, $dossier . $_SESSION['mail'] . ".jpeg");
       //ajout_image($fichier,);
     }
     else //sinon, cas où la fonction renvoie FALSE
     {
       echo 'Echec de l\'upload les dimensions sont sûrement trop élévés !';
       }
   }
   else
   {
     echo $erreur;
   }

   $pseudo = $_POST['newPseudo'];
   $phone = $_POST['newPhone'];
   $content = $_POST['newContent'];
   $picture = "/Viaxe/images/guide/".$_SESSION['mail'] . ".jpeg";
   $password = chiffer($_POST['newPassword']);
   $confirm = chiffer($_POST['confirmNewPassword']);

   if(!isset($_POST['newPassword']) & empty($_POST['newPassword']) & !isset($_POST['confirmNewPassword']) & empty($_POST['confirmNewPassword']))
   {
   if($password == $confirm){

   $req = $bdd->prepare('UPDATE GUIDE SET pseudo=:pseudo, phone=:phone, description=:content,
     password=:password, picture=:picture WHERE mail=:mail');


   $req->execute(array(
     "pseudo"=>$pseudo,
     "phone"=>$phone,
     "content"=>$content,
     "picture"=>$picture,
     "password"=>$password,
     "mail"=>$_SESSION['mail']
     ));

     header('Location:index.php');

   }
   else{
     header('Location:myProfilGuide.php?error=wrongPassword');
   }
 }
 else{
   if($password == $confirm){

   $req = $bdd->prepare('UPDATE GUIDE SET pseudo=:pseudo, phone=:phone, description=:content, picture=:picture WHERE mail=:mail');


   $req->execute(array(
     "pseudo"=>$pseudo,
     "phone"=>$phone,
     "content"=>$content,
     "picture"=>$picture,
     "mail"=>$_SESSION['mail']
     ));

     header('Location:index.php');

   }
 }
