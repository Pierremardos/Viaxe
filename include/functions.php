<?php

define("DB_HOST", "localhost");
define("DB_NAME", "viaxe");
define("DB_USER", "root");
define("DB_PWD", "");

function connectDb(){
  try{
    $db = new PDO('mysql:host=localhost;dbname=viaxe' , 'root' , '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  }catch(Exception $e){
    die("Erreur SQL : ".$e->getMessage());
  }
return $db;
}

function backOffice(){

  $db = connectDb();
  $query = $db->prepare("SELECT Id,mail,pseudo,isBanned FROM client");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
      <td>'.$member["Id"].'</td>
      <td>'.$member["mail"].'</td>
      <td>'.$member["pseudo"].'</td>
      <td>'.$member["isBanned"].'</td>';
    if($member["isBanned"] == 0){
      echo'
      <td>
        <form method="GET" action="delete.php">
          <input  name="Id" type="hidden" value="'.$member["Id"].'"/>
          <input type="submit" value="Ban"/>
        </form>
      </td>
    </tr>
    ';
    }
    if($member["isBanned"] == 1){
      echo'
      <td>
        <form method="GET" action="delete.php">
          <input  name="Id" type="hidden" value="'.$member["Id"].'"/>
          <input type="submit" value="Unban"/>
        </form>
      </td>
    </tr>
    ';
    }
  }
}

function deleteUser($Id){
  $db = connectDb();
  $query = $db->prepare("UPDATE client SET isBanned = 1 WHERE Id = :id");
  $query->execute(["id"=>$Id]);

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
