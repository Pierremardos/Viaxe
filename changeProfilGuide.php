<?php
session_start();
include 'include/config.php';
include 'include/functions.php';

$dip = 0;
$profil = 0;

$query=$bdd->prepare('SELECT *
FROM GUIDE WHERE mail = :mail');
$query->bindValue(':mail',$_SESSION['mail'], PDO::PARAM_STR);
$query->execute();
$data=$query->fetch();

if(!empty($_FILES['avatar']['name'])){
$dossier = 'images/guide/';
   $fichier = basename($_FILES['avatar']['name']);
   $taille_maxi = 300000;
   $taille = filesize($_FILES['avatar']['tmp_name']);
   $extensions = array('.png', '.gif', '.jpg', '.jpeg');
   $extension = strrchr($_FILES['avatar']['name'], '.');

   //Début des vérifications de sécurité...
   if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
   {
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
     $profil++;
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
       $profil = 10;
       rename($dossier . $fichier, $dossier . $_SESSION['mail'].".jpeg");
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
 }

   if(!empty($_FILES['avatar2']['name']) & !empty($_FILES['avatar3']['name'])){

   $dossier2 = 'images/guide/docs/';
      $fichier = basename($_FILES['avatar2']['name']);
      $taille_maxi = 300000;
      $taille = filesize($_FILES['avatar2']['tmp_name']);
      $extensions = array('.png', '.gif', '.jpg', '.jpeg');
      $extension = strrchr($_FILES['avatar2']['name'], '.');

      //Début des vérifications de sécurité...
      if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
      {
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
        $dip++;
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
        if(move_uploaded_file($_FILES['avatar2']['tmp_name'], $dossier2 . $fichier)) //correct si la fonction renvoie TRUE
        {
          echo 'Upload effectué avec succès !';
          $dip = $dip + 5;
          rename($dossier2 . $fichier, $dossier2 . $_SESSION['mail'] . "dip.jpeg");
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

         $fichier = basename($_FILES['avatar3']['name']);
         $taille_maxi = 300000;
         $taille = filesize($_FILES['avatar3']['tmp_name']);
         $extensions = array('.png', '.gif', '.jpg', '.jpeg');
         $extension = strrchr($_FILES['avatar3']['name'], '.');

         //Début des vérifications de sécurité...
         if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
         {
           $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
           $dip++;
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
           if(move_uploaded_file($_FILES['avatar3']['tmp_name'], $dossier2 . $fichier)) //correct si la fonction renvoie TRUE
           {
             echo 'Upload effectué avec succès !';
             $dip = $dip + 10;
             rename($dossier2 . $fichier, $dossier2 . $_SESSION['mail'] . "cni.jpeg");
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

       }


   $pseudo = htmlspecialchars($_POST['newPseudo']);
   $phone = htmlspecialchars($_POST['newPhone']);
   $content = htmlspecialchars($_POST['newContent']);
   $password = chiffer($_POST['newPassword']);
   $confirm = chiffer($_POST['confirmNewPassword']);


   $picture = "/Viaxe/images/guide/".$_SESSION['mail'] . ".jpeg";

   if($data['diploma'] != "ok" & $dip == 15){
   $diploma = "envoie";
 }
 else if($data['diploma'] == "ok"){
   $diploma = "ok";
 }
 else{
   $diploma = "vide";
 }


   $diplome = "/Viaxe/images/guide/docs/".$_SESSION['mail'] . "dip.jpeg";
   $identite = "/Viaxe/images/guide/docs/".$_SESSION['mail'] . "cni.jpeg";

     $req = $bdd->prepare('UPDATE GUIDE SET diplome=:diplome, diploma= :diploma, Identite=:identite WHERE mail=:mail');


     $req->execute(array(
       "diplome"=>$diplome,
       "diploma"=>$diploma,
       "identite"=>$identite,
       "mail"=>$_SESSION['mail']
       ));



   if(!(!isset($_POST['newPassword']) | empty($_POST['newPassword']) | !isset($_POST['confirmNewPassword']) | empty($_POST['confirmNewPassword'])))
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

    header('Location:myProfilGuide.php');
   }
 }
