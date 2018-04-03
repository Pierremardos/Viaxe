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
 	Pseudo :  <?php echo $donnees['pseudo']; ?>
 	<br>
 	Nom : <?php echo $donnees['lastName']; ?>
 	<br>
 	Prénom : <?php echo $donnees['firstName']; ?>
  <br>
  Tél : <?php echo $donnees['phone']; ?>
 </p>

 <?php
 }

 $query->closeCursor();

 $query=$bdd->prepare('SELECT * FROM TRIP WHERE mailGuide = :mail');
 $query->bindValue(':mail',$mail, PDO::PARAM_STR);
 $query->execute();

 while($donnees = $query->fetch())
 {

 ?>

 <h1>Mes parcours</h1>
 <br>
 <p>
 Titre :  <?php echo $donnees['title']; ?>
</p>

<?php
}

$query->closeCursor();
?>
