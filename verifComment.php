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

  $comment = $_POST['comment'];
  $mark = $_POST['mark'];
  $id = $_GET['id'];
  $mail  = $_SESSION['mail'];

  $req = $bdd->prepare('INSERT INTO RECOMMENDATION (comment, timeComment, mark, mailCustomer, idTrip)
  VALUES (:comment, NOW(), :mark, :mailCustomer, :id)');


  $req->execute(array(
    "comment"=>$comment,
    "mark"=>$mark,
    "mailCustomer"=>$mail,
    "id"=>$id
    ));

    header('Location: parcours.php?id='.$id.'');
    exit;
?>
