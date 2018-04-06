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

 $query=$bdd->prepare('SELECT * FROM CUSTOMER WHERE mail = :mail');
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
   <form action="changeProfilCustomer.php" method="post" enctype='multipart/form-data'>
	Mail :  <?php echo $donnees['mail']; ?>
  <br>
 	Pseudo :  <?php echo '<input type="text" name="newPseudo" value="'.$donnees['pseudo'].'"/>' ?>
 	<br>
  Photo de profil :
  <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
  <input type='file' name='avatar'>
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
  Tél : <?php echo '<input type="text" name="newPhone" value="'.$donnees['phone'].'"/>' ?>
  <br>
  Nouveau mot de passe :  <?php echo '<input type="password" name="newPassword"/>' ?>
  <br>
  Confirmer le nouveau mot de passe :  <?php echo '<input type="password" name="confirmNewPassword"/>' ?>
  <br>
  <input type="submit" value="Valider">
  </form>
 </p>

 <?php
 }

 $query->closeCursor();
 ?>
