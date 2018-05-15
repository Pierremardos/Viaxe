<?php
include '../include/config.php';
require_once '../include/functions.php';
include '../Navbar/NavbarBackOffice.php';
session_start();
if($_SESSION['mail'] == 'quentin.clodion@gmail.com'
  | $_SESSION['mail'] =='jonasnizard@gmail.com'
  | $_SESSION['mail'] == 'thomas.ddt@hotmail.fr'){

  }else{
    header("location: ../index.php");
    exit;
}
echo'<div class="container">';
echo'</div>
  <div class="container">
    <form method="POST" action="messageBackOffice.php">
      <input type="mail" value="" name="mailCustomer" placeholder="mail"/>
      <input type="text" value="" name="comment" placeholder="reponse"/>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
  </div>
  ';
  ShowMessageBackOffice();
?>
