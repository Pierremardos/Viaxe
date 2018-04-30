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
 $count = 0;

 while($donnees = $query->fetch())
 {
   $date = strtotime($donnees['date']);
   if($date > $now){
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
  }

$query->closeCursor();
?>
