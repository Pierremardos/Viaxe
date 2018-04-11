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

  $id = $_GET['id'];
  $query=$bdd->prepare('SELECT * FROM TRIP WHERE id = :id');
  $query->bindValue(':id',$id, PDO::PARAM_STR);
  $query->execute();

$donnees = $query->fetch()
?>
  <br>
  <br>
  <br>
	<?php echo '<h1>'.$donnees['title'].'</h1>'; ?>
  <?php echo $donnees['map']; ?>
