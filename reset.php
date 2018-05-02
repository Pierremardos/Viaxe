<?php
  session_start();
  include 'include/config.php';
  include 'include/functions.php';
  $id = $_GET['id'];

  $query=$bdd->prepare('SELECT mailGuide
  FROM TRIP WHERE id = :id');
  $query->bindValue(':id',$id, PDO::PARAM_STR);
  $query->execute();
  $data=$query->fetch();

  if($data['mailGuide'] == $_SESSION['mail']){
  resetPlaces($id);
  header('location:parcours.php?id='.$id.'');
  exit;
}
else{
  header('location:parcours.php?id='.$id.'');
  exit;
}
?>
