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


 ?>
