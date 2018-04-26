<?php
session_start();
include 'include/config.php';
include 'include/functions.php';

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

 $mail = $_SESSION['mail'];
 $now = strtotime("now") + 7200;
 $query=$bdd->prepare('SELECT * FROM TRIP WHERE mailGuide = :mail');
 $query->bindValue(':mail',$mail, PDO::PARAM_STR);
 $query->execute();

 while($donnees = $query->fetch())
 {
   $date = strtotime($donnees['date']);
   if($date > $now){
 ?>


 <br>
 <p>
 <?php echo '<a href = parcours.php?id='.$donnees['id'].'><img src="'.$donnees['picture'].'" alt="" /></a>'; ?>
 <br>
 <?php echo '<a href = parcours.php?id='.$donnees['id'].'>'.$donnees['title'].'</a>'; ?>
</p>

<?php
    }
  }

$query->closeCursor();
?>
