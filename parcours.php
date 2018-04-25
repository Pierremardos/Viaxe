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
      $particip = 0;
    }
    else if ($_SESSION['mail'] == $data['mail'])
     {
         include('Navbar/NavbarGuide.php');
         $particip = 0;
     }
     else{
       include('Navbar/NavbarCustomer.php');
       $particip = 1;
     }
  }
  else{
    include('Navbar/Navbar.php');
    $particip = 0;
  }

  $id = $_GET['id'];
  $query=$bdd->prepare('SELECT * FROM TRIP WHERE id = :id');
  $query->bindValue(':id',$id, PDO::PARAM_STR);
  $query->execute();

$donnees = $query->fetch()
?>
<!DOCTYPE html>
<html>
  <head>
  	<title>Viaxe</title>
  	<meta charset="utf-8">
  	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  <br>
  <br>
  <br>
	<?php echo '<h1>'.$donnees['title'].'</h1>'; ?>
  <?php echo '<h1>'.$donnees['mark'].'</h1>'; ?>
  <?php echo $donnees['map']; ?>

  <?php
  $now = strtotime("now") + 7200;
  $date = strtotime($donnees['date']);

    if($particip = 1 & $date > $now){
      echo '<form action="inscriptionParcours.php?id='.$_GET['id'].'" method="post">
      <input type="submit" value="participer"/>
      </form>';
    }
   ?>

   <?php
   $rep=$bdd->prepare('SELECT mailCustomer FROM PARTICIPANT WHERE idTrip = :id');
   $rep->bindValue(':id',$id, PDO::PARAM_STR);
   $rep->execute();
   while($data=$rep->fetch()){
   $verifmail = $data['mailCustomer'];
   $mail = $_SESSION['mail'];
   if($verifmail == $mail){
    ?>
    <?php
    echo
    '<form action="verifComment.php?id='.$_GET['id'].'" method="post">
      Note : <input type="text" name="mark">
      <br>
      Message :<input type="text" name="comment">
      <br>
      <input type="submit" value="Envoyer">
    </form>';
  }
}
    ?>
    <?php
    $query=$bdd->prepare('SELECT * FROM RECOMMENDATION WHERE idTrip = :id');
    $query->bindValue(':id',$id, PDO::PARAM_STR);
    $query->execute();
    while($donnees = $query->fetch())
    {
      $rep=$bdd->prepare('SELECT * FROM CUSTOMER WHERE mail = :mail');
      $rep->bindValue(':mail',$donnees['mailCustomer'], PDO::PARAM_STR);
      $rep->execute();
      $data = $rep->fetch();
    ?>
    <br>
    <br>
    <?php echo $data['pseudo'];?>
    <br>
    <?php echo $donnees['timeComment'];?>
    <br>
    <?php echo $donnees['comment'];?>
    <?php
  }
     ?>
  </body>
</html>
