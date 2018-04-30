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
$count = 0;

while($donnees = $query->fetch())
{
  $rep=$bdd->prepare('SELECT * FROM TRIP WHERE id = :id');
  $rep->bindValue(':id',$donnees['idTrip'], PDO::PARAM_STR);
  $rep->execute();
  $data = $rep->fetch();
  if(strtotime($data['date']) > $now){
?>
<?php
  if($count % 2 == 0){
echo '
 <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-7 align-self-center">
          <a href = parcours.php?id='.$data['id'].'>
          <h3>'.$data['title'].'</h3>
          </a>
          <p class="my-3">'.$data['content'].'</p>
        </div>
        <div class="col-md-5">
          <a href = parcours.php?id='.$data['id'].'>
          <img class="img-fluid d-block" src="'.$data['picture'].'"> </div>
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
      <a href = parcours.php?id='.$data['id'].'>
        <img class="img-fluid d-block" src="'.$data['picture'].'"> </div>
      </a>
      <div class="col-md-7 order-1 order-md-2">
      <a href = parcours.php?id='.$data['id'].'>
          <h3>'.$data['title'].'</h3>
        </a>
        <p class="my-3">'.$data['content'].'</p>
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

 ?>
