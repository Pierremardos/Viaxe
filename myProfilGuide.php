<?php
session_start();
include 'include/config.php';
include 'include/functions.php';
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Viaxe</title>
 	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
   <link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css">
</head>
 <?php
 if(isset($_SESSION['mail'])){

   $query=$bdd->prepare('SELECT mail
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
      include('Navbar/NavbarCustomer.php');
    }
 }
 else{
   include('Navbar/Navbar.php');
 }
 ?>

<?php
 $mail = $_SESSION['mail'];

 $query=$bdd->prepare('SELECT * FROM GUIDE WHERE mail = :mail');
 $query->bindValue(':mail',$mail, PDO::PARAM_STR);
 $query->execute();

 $donnees = $query->fetch();
?>
<?php
 echo
 '<div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-5 order-2 order-md-1">
          <img class="img-fluid d-block" src="'.$donnees['picture'].'" width="400px"> </div>
        <div class="col-md-7 order-1 order-md-2">
          <h3>'.$donnees['lastName'].' '.$donnees['firstName'].' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'.$donnees['mark'].'/5 &nbsp;</h3>
          <br>Sexe : ';?>
          <?php if($donnees['gender']==1){
            echo "Homme";
          }
          else{
            echo "Femme";
          }
          ?>
          <?php echo'
          <form action="changeProfilGuide.php" method="post" enctype="multipart/form-data">
          Mail : '.$donnees['mail'].'
          <br>Date de naissance : '.$donnees['age'].'
          <br>Langues : '.$donnees['languages'].'
          <div class="form-group">
          <label>Nouvel photo de profil :</label>
          <input type="hidden" name="MAX_FILE_SIZE" value="250000">
          <input type="file" name="avatar">
          </label>
          </div>
          <div class="form-group">
              <label>Pseudo :</label>
              <input type="text" class="form-control w-50" name="newPseudo" value="'.$donnees['pseudo'].'">
              <small class="form-text text-muted"></small>
          </div>
          <div class="form-group">
              <label>Mot de passe :</label>
              <input type="text" class="form-control w-50" name="newPassword"">
              <small class="form-text text-muted"></small>
          </div>
          <div class="form-group">
              <label>Mot de passe :</label>
              <input type="text" class="form-control w-50" name="confirmNewPassword"">
              <small class="form-text text-muted"></small>
          </div>
          <div class="form-group">
              <label>Téléphone :</label>
              <input type="text" class="form-control w-50" name="newPhone"" value="'.$donnees['phone'].'">
              <small class="form-text text-muted"></small>
          </div>
          <div class="form-group">
              <label>Ajouter un diplôme :</label>
              <input type="hidden" name="MAX_FILE_SIZE" value="250000">
              <input type="file" name="avatar2">
          </div>
          <div class="form-group">
              <label>Papier d identité à fournir avec le diplôme :</label>
              <input type="hidden" name="MAX_FILE_SIZE" value="250000">
              <input type="file" name="avatar3">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Description :</label>
            <input type="text" class="form-control w-100" name="newContent" value="'.$donnees['description'].'">
            <small class="form-text text-muted"></small>
            <br>
            <input type="submit" value="Valider">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>';
?>

<div class="py-5 bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Parcours</h1>
        </div>
      </div>
    </div>
  </div>

 <?php

 $query->closeCursor();

 $query=$bdd->prepare('SELECT * FROM TRIP WHERE mailGuide = :mail');
 $query->bindValue(':mail',$mail, PDO::PARAM_STR);
 $query->execute();
 $count = 0;

 while($donnees = $query->fetch())
 {

 ?>

 <?php
   if($count % 2 == 0){
 echo '
  <div class="py-5">
     <div class="container">
       <div class="row">
         <div class="col-md-7 align-self-center">
           <a href = parcours.php?id='.$donnees['id'].'>
           <h3>'.$donnees['title'].'</h3>
           </a>
           <p class="my-3">'.$donnees['content'].'</p>
         </div>
         <div class="col-md-5">
           <a href = parcours.php?id='.$donnees['id'].'>
           <img class="img-fluid d-block" src="'.$donnees['picture'].'"> </div>
           </a>
       </div>
     </div>
   </div>';
 }
   else{
 echo '
 <div class="py-5">
   <div class="container">
     <div class="row">
     <div class="col-md-5 order-2 order-md-1">
       <a href = parcours.php?id='.$donnees['id'].'>
         <img class="img-fluid d-block" src="'.$donnees['picture'].'"> </div>
       </a>
       <div class="col-md-7 order-1 order-md-2">
       <a href = parcours.php?id='.$donnees['id'].'>
           <h3>'.$donnees['title'].'</h3>
         </a>
         <p class="my-3">'.$donnees['content'].'</p>
         </div>
     </div>
   </div>
 </div>';
 }
 $count = $count + 1;
   ?>

<?php
}

$query->closeCursor();
?>
