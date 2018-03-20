<?php

define("DB_HOST", "localhost");
define("DB_NAME", "viaxe");
define("DB_USER", "root");
define("DB_PWD", "");

function connectDb(){
  try{
    $db = new PDO('mysql:host=localhost;dbname=viaxe' , 'root' , '');
  }catch(Exception $e){
    die("Erreur SQL : ".$e->getMessage());
  }
return $db;
}

function backOffice(){

  $db = connectDb();
  $query = $db->prepare("SELECT Id,mail,pseudo FROM client");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
      <td>'.$member["Id"].'</td>
      <td>'.$member["mail"].'</td>
      <td>'.$member["pseudo"].'</td>
      <td>
        <form method="GET" action="delete.php">
          <input  name="id" type="hidden" value="'.$member["Id"].'"/>
          <input type="submit" value="supprimer"/>
        </form>
      </td>
    </tr>
    ';

  }
}

function deleteUser($Id){
  $db = connectDb();
  $query = $db->prepare("DELETE FROM client WHERE Id = :id");
  $query->execute(["Id"=>$Id]);

}


function erreur($err='')
{
 $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
 exit('<p>'.$mess.'</p>
 <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></body></html>');
}

function chiffer ($password){
  $salage='SuP4rS4aL4g3';
  return hash('md5',$salage.$password);
}
 ?>
