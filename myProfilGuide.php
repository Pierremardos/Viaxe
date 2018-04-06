<?php
session_start();
include 'include/config.php';
include 'include/functions.php';
 ?>
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

 while($donnees = $query->fetch())
 {
 ?>

 <p>
   <br>
   <br>
   <br>
   <?php
   $picture = $donnees['picture'];
   ?>
   <?php echo '<img src="'.$picture.'" alt="" />'; ?>
   <br>
   <form action="changeProfilGuide.php" method="post" enctype='multipart/form-data'>
	Mail :  <?php echo $donnees['mail']; ?>
  <br>
 	Pseudo :  <?php echo '<input type="text" name="newPseudo" value="'.$donnees['pseudo'].'"/>' ?>
 	<br>
  Photo de profil :
  <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
  <input type='file' name='avatar'>
  <br>
 	Nom : <?php echo $donnees['lastName']; ?>
 	<br>
 	Prénom : <?php echo $donnees['firstName']; ?>
  <br>
  Note : <?php echo $donnees['mark']; ?>
  <br>
  Date de naissance :  <?php echo $donnees['age']; ?>
  <br>
  Sexe :
  <?php
  if($donnees['gender']==1){
    echo "Homme";
  }
  else{
    echo "Femme";
  }?>
  <br>
  Langues :  <?php echo $donnees['languages']; ?>
  <br>
  Tél : <?php echo '<input type="text" name="newPhone" value="'.$donnees['phone'].'"/>' ?>
  <br>
  Description :  <?php echo '<input type="text" name="newContent" value="'.$donnees['description'].'"/>' ?>
  <br>
  Nouveau mot de passe :  <?php echo '<input type="password" name="newPassword"/>' ?>
  <br>
  Confirmer le nouveau mot de passe :  <?php echo '<input type="password" name="confirmNewPassword"/>' ?>
  <br>
  <input type="submit" value="Valider">
  </form>
 </p>

<h1>Mes parcours</h1>

 <?php
 }

 $query->closeCursor();

 $query=$bdd->prepare('SELECT * FROM TRIP WHERE mailGuide = :mail');
 $query->bindValue(':mail',$mail, PDO::PARAM_STR);
 $query->execute();

 while($donnees = $query->fetch())
 {

 ?>

 <br>
 <p>
 Titre :  <?php echo $donnees['title']; ?>
</p>

<?php
}

$query->closeCursor();
?>
