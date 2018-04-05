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

    if ($_SESSION['mail'] == $data['mail'])
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
	Mail :  <?php echo $donnees['mail']; ?>
  <br>
 	Pseudo :  <?php echo $donnees['pseudo']; ?>
  <form action="changePseudo.php" method="post">
  <input type="submit" value="Changer le pseudo">
  </form>
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
  <form action="changeLangues.php" method="post">
  <input type="submit" value="Changer les langues">
  </form>
  <br>
  Tél : <?php echo $donnees['phone']; ?>
  <form action="changePhone.php" method="post">
  <input type="submit" value="Changer le numéro de téléphone">
  </form>
  <br>
  Description :  <?php echo $donnees['description']; ?>
  <form action="changeContent.php" method="post">
  <input type="submit" value="Changer la description">
  </form>
  <br>
  <form action="changePassword.php" method="post">
  <input type="submit" value="Changer le mot de passe">
  </form>
  <br>
  <form action="changePhoto.php" method="post">
  <input type="submit" value="Changer la photo">
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
