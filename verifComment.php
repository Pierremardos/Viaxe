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

  $comment = htmlspecialchars($_POST['comment']);
  $mark = htmlspecialchars($_POST['mark']);
  $id = htmlspecialchars($_GET['id']);
  $mail  = $_SESSION['mail'];

  $query=$bdd->prepare('SELECT idTrip
  FROM RECOMMENDATION WHERE mailCustomer = :mail AND idTrip = :id');
  $query->execute(array(
    "mail"=>$mail,
    "id"=>$id
    ));
  $donnees=$query->fetch();

  if($mark >= 0 & $mark <= 5) {

  if($donnees['idTrip'] == $id){
    $req=$bdd->prepare('DELETE FROM RECOMMENDATION WHERE mailCustomer = :mail AND idTrip = :id');
    $req->execute(array(
      "mail"=>$mail,
      "id"=>$id
      ));
  }

  $req = $bdd->prepare('INSERT INTO RECOMMENDATION (comment, timeComment, mark, mailCustomer, idTrip)
  VALUES (:comment, NOW(), :mark, :mailCustomer, :id)');

  $req->execute(array(
    "comment"=>$comment,
    "mark"=>$mark,
    "mailCustomer"=>$mail,
    "id"=>$id
    ));

    $query=$bdd->prepare('SELECT AVG(mark)
    FROM RECOMMENDATION WHERE idTrip = :id');
    $query->bindValue(':id',$id, PDO::PARAM_STR);
    $query->execute();
    $donnees2=$query->fetch();
    $note = $donnees2['AVG(mark)'];

    $query=$bdd->prepare('UPDATE TRIP
    SET mark = :mark WHERE id = :id');
    $query->execute(array(
      "mark"=>$note,
      "id"=>$id
      ));

      $query=$bdd->prepare('UPDATE GUIDE SET mark = (SELECT AVG(mark)
      FROM TRIP WHERE mailGuide = (SELECT mailGuide
      FROM TRIP WHERE id = :id)) WHERE mail = (SELECT mailGuide
      FROM TRIP WHERE id = :id)');
      $query->bindValue(':id',$id, PDO::PARAM_STR);
      $query->execute();

    }

    header('Location: parcours.php?id='.$id.'');
    exit;
?>
