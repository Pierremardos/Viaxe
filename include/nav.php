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
