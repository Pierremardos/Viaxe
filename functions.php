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
