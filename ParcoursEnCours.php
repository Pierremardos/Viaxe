<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
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

$query=$bdd->prepare('SELECT idTrip FROM PARTICIPANT WHERE mailCustomer = :mail');
$query->bindValue(':mail',$mail, PDO::PARAM_STR);
$query->execute();
$now = strtotime("now") + 7200;

while($donnees = $query->fetch())
{
  $rep=$bdd->prepare('SELECT * FROM TRIP WHERE id = :id');
  $rep->bindValue(':id',$donnees['idTrip'], PDO::PARAM_STR);
  $rep->execute();
  $data = $rep->fetch();
  if(strtotime($data['date']) > $now){
?>

<br>
<p>
<?php echo '<a href = parcours.php?id='.$data['id'].'><img src="'.$data['picture'].'" alt="" /></a>'; ?>
<br>
<?php echo '<a href = parcours.php?id='.$data['id'].'>'.$data['title'].'</a>'; ?>
</p>

<?php
 }
}

 ?>
