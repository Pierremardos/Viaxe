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
      $particip = 1;
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
    $particip = 1;
  }

  $id = $_GET['id'];
  $query=$bdd->prepare('SELECT * FROM TRIP WHERE id = :id');
  $query->bindValue(':id',$id, PDO::PARAM_STR);
  $query->execute();

$donnees = $query->fetch();

$now = strtotime("now") + 7200;
$date = strtotime($donnees['datePrice']);
if($now >= $date){
  $query=$bdd->prepare('UPDATE TRIP SET price = finalPrice WHERE id = :id');
  $query->bindValue(':id',$id, PDO::PARAM_STR);
  $query->execute();
}
?>
<!DOCTYPE html>
<html>
  <head>
  	<title>Viaxe</title>
  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css">
  </head>
  <body onload="bigMap()">
    <?php echo
  '<div class="py-5 text-center h-100" style="background-image: url('.$donnees['picture'].'); background-size: cover;">
  <div class="container py-5">
    <div class="row">
    </div>
  </div>
  </div>
  <div class="py-5 bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="display-3 mb-4 text-light">'.$donnees['title'].'
            <br> </h1>
          <h1 class="text-light">
            <b>'.$note = round ($donnees['mark'], $precision = 1).'/5</b>
          </h1>
        </div>
      </div>
    </div>
  </div>';

  $rep=$bdd->prepare('SELECT * FROM GUIDE WHERE mail = (SELECT mailGuide FROM TRIP WHERE id = :id)');
  $rep->bindValue(':id',$id, PDO::PARAM_STR);
  $rep->execute();
  $now = strtotime("now") + 7200;
  $date = strtotime($donnees['date']);
  $minutes = $donnees['duration'] %60;
  $hour = ($donnees['duration'] - $minutes )/60;

  $req=$bdd->prepare('SELECT * FROM PARTICIPANT WHERE idTrip = :id');
  $req->bindValue(':id',$_GET['id'], PDO::PARAM_STR);
  $req->execute();
  while($dataInscrit = $req->fetch()){
    if(isset($_SESSION['mail'])){
  if($dataInscrit['mailCustomer'] == $_SESSION['mail']){
    $particip = 2;
  }
}
}
$data = $rep->fetch();

  echo
  '<div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-5 order-2 order-md-1">
          <a href="seeProfil.php?id='.$data['id'].'&role=g">
          <img class="img-fluid d-block" src="'.$data['picture'].'"> </div>
        <div class="col-md-7 order-1 order-md-2">
          <h3>Organisé par '.$data['pseudo'].' </a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; '.$note = round ($data['mark'], $precision = 1).'/5</h3>
            <p class="my-3">Date de naissance : '.$data['age'].'
            <br>Langues : '.$data['languages'].'
            <br>Téléphone :&nbsp '.$data['phone'].'
            <br>Mail :&nbsp '.$data['mail'].'
            <br> </p>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          '.$donnees['map'].'
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p class="text-center">'.$donnees['country'].', '.$donnees['city'].'&nbsp;
            <br>Départ : '.$donnees['date'].'';
            if($hour > 0 | $minutes > 0){
            echo'
            <br>Durée du parcours : ';
          }
            if($hour > 0){
            echo ''.$hour.'h';
          }
            if($minutes > 0){
             echo ''.$minutes.'min';
           }
           echo'
            <br>Prix : '.$donnees['price'].'€
            <br>Categorie : '.$donnees['category'].'
            <br>Places restantes : '.$donnees['places'].'
            <br>Langues utilisés : '.$donnees['languages'].'';
              if($particip == 1 & $date > $now){
                echo '<br>
                <a href="inscriptionParcours.php?id='.$_GET['id'].'""> Participer </a>
                </p>';
              };
        echo'</div>
      </div>
    </div>
  </div>
  <div class="py-5">';

  $req=$bdd->prepare('SELECT * FROM CONTENT WHERE idTrip = :id');
  $req->bindValue(':id',$id, PDO::PARAM_STR);
  $req->execute();
  $count = 0;
  while($donnees = $req->fetch()){

    if($count % 3 == 0 & $count < 3){
echo '
    <div class="container">
      <div class="row mb-5">
      ';
      if(isset($donnees['content']) & !empty($donnees['content'])){
      echo'
        <div class="col-md-7">
          <p class="text-justify">'.$donnees['content'].'</p>
        </div>
        ';
      }
      if(isset($donnees['Picture']) & !empty($donnees['Picture'])){
        echo'
        <div class="col-md-5 align-self-center">
          <img class="img-fluid d-block w-100 img-thumbnail" src="'.$donnees['Picture'].'"> </div>
      </div>';
    }
      $count++;
    }
    else if($count % 3 == 1 & $count < 3){
      echo'<div class="row">';
        if(isset($donnees['Picture']) & !empty($donnees['Picture'])){
          echo'
        <div class="col-md-5">
          <img class="img-fluid d-block mb-4 w-100 img-thumbnail" src="'.$donnees['Picture'].'"> </div>';
        }
          if(isset($donnees['content']) & !empty($donnees['content'])){
          echo'<div class="col-md-7">
          <p class="text-justify">'.$donnees['content'].'</p>
        </div>';
      }
      echo'
      </div>
    </div>';
    $count++;
  }
    else if ($count % 3 == 2 & $count < 3){
      echo'
    <div class="container">
      <div class="row mb-5 my-5">
      ';
      if(isset($donnees['content']) & !empty($donnees['content'])){
      echo'
        <div class="col-md-7">
          <p class="text-justify">'.$donnees['content'].'</p>
        </div>';
        }
        if(isset($donnees['Picture']) & !empty($donnees['Picture'])){
          echo'
        <div class="col-md-5 align-self-center">
          <img class="img-fluid d-block w-100 img-thumbnail" src="'.$donnees['Picture'].'"> </div>
      </div>';
    }
    echo'
    </div>
  </div>';
  $count++;
}
}
?>
<?php
if($particip == 0){
$rep=$bdd->prepare('SELECT * FROM TRIP WHERE id = :id');
$rep->bindValue(':id',$id, PDO::PARAM_STR);
$rep->execute();
$data=$rep->fetch();

if($_SESSION['mail'] == $data['mailGuide']){
echo'
<div class="py-5 bg-primary">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
       <h1 class="text-light text-center">Modification</h1>
     </div>
   </div>
 </div>
</div>
<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p class="text-center"><a href="inscrits.php?id='.$id.'">Liste des inscrits </a>
          <br><a href="changeParcours.php?id='.$id.'">Renouveler</a>
          <br><a href="reset.php?id='.$id.'">Fermer le parcours</a>
        </p>
          </div>
        </div>
      </div>
    </div>';
}}
 ?>

   <div class="py-5 bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-light text-center">Avis</h1>
        </div>
      </div>
    </div>
  </div>
<?php
   $rep=$bdd->prepare('SELECT mailCustomer FROM PARTICIPANT WHERE idTrip = :id');
   $rep->bindValue(':id',$id, PDO::PARAM_STR);
   $rep->execute();
   while($data=$rep->fetch()){
   $verifmail = $data['mailCustomer'];
   if(!isset($_SESSION['mail']) | empty( $_SESSION['mail'])){
     $mail = "nada";
   }
   else{
   $mail = $_SESSION['mail'];
 }
   if($verifmail == $mail){
    ?>
    <?php
    echo
    ' <div class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-7 order-1 order-md-2">
            <form action="verifComment.php?id='.$_GET['id'].'" method="post">
            <div class="form-group">
                <label>Note :</label>
                <input type="text" class="form-control w-50" name="mark">
                <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label>Commentaire :</label>
                <input type="text" class="form-control w-50" name="comment">
                <small class="form-text text-muted"></small>
            </div>
            <input type="submit" value="Envoyer">
            </form>
          </div>
        </div>
      </div>';
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
    <?php
    echo '<div class="py-5">
   <div class="container">
     <div class="row">
       <div class="col-md-2 order-2 order-md-1">
         <a href="seeProfil.php?id='.$data['id'].'&role=c">
         <img class="img-fluid d-block" src="'.$data['picture'].'" width="150px"> </div>
       <div class="col-md-7 order-1 order-md-2">
         <h4>'.$data['pseudo'].' </a> <br> '.$note = round ($donnees['mark'], $precision = 1).'/5
           <br>
         </h4>';
         if($data['level'] >= 100 & $data['level'] < 200){
           echo'Premiers pas';
         }
         else if($data['level'] >= 200 & $data['level'] < 300){
           echo'Nouveau marcheur';
         }
         else if($data['level'] >= 300 & $data['level'] < 400){
           echo'Aventurier';
         }
         else{
           echo"Marcheur de l'extrême";
         }
         echo'
         <p class="">'.$donnees['timeComment'].'</p>
       </div>
     </div>
     <div class="row">
       <div class="col-md-12">
         <p class="my-3">'.$donnees['comment'].'</p>
       </div>
     </div>
   </div>
 </div>';
 ?>
    <?php
  }
     ?>
     <script src="include/functions.js"></script>
  </body>
</html>
