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
  $query = $db->prepare("SELECT mail,pseudo,age,gender,isBanned FROM customer");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
      <td>'.$member["mail"].'</td>
      <td>'.$member["pseudo"].'</td>
      <td>'.$member["age"].'</td>
      <td>'.$member["gender"].'</td>
      <td>'.$member["isBanned"].'</td>';
    if($member["isBanned"] == 0){
      echo'
      <td>
        <form method="GET" action="ban.php">
          <input  name="mail" type="hidden" value="'.$member["mail"].'"/>
          <button type="submit" class="btn btn-danger">
            <span class="glyphicon glyphicon-remove-circle"></span>
          </button>
        </form>
      </td>
      <td>
        <form method="GET" action="edit.php">
          <input name="mail" type="hidden" value="'.$member["mail"].'"/>
          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
        </td>
    </tr>
    ';
    }
    if($member["isBanned"] == 1){
      echo'
      <td>
        <form method="GET" action="unban.php">
          <input  name="mail" type="hidden" value="'.$member["mail"].'"/>
          <button type="submit" class="btn btn-danger">
            <span class="glyphicon glyphicon-ok-circle"></span>
          </button>
        </form>
      </td>
    </tr>
    ';
    }
  }
}

function banUser($mail){
  $db = connectDb();
  $query = $db->prepare("UPDATE customer SET isBanned = 1 WHERE mail = :mail");
  $query->execute(["mail"=>$mail]);

}

function unbanUser($mail){
  $db = connectDb();
  $query = $db->prepare("UPDATE customer SET isBanned = 0 WHERE mail = :mail");
  $query->execute(["mail"=>$mail]);
}

function editUser($mail){
  $db = connectDb();
  $query = $db->prepare('UPDATE customer SET mail = $_GET["mail"], pseudo = $_GET["pseudo"], age = $_GET["age"], gender = $_GET["gender"], isBanned = $_GET["isBanned"] WHERE mail =:mail');
  $query->execute(["mail"=>$mail]);
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

function check ($mail){
  $db = connectDb();
  $query=$db->prepare('SELECT COUNT (pseudo) FROM GUIDE WHERE mail = :mail');
  $query->bindValue(':mail',$mail, PDO::PARAM_STR);
  $query->execute();
  $count=$query->fetch();
  $query->CloseCursor();
  if($count == 1){
    return 1;
  }
  else{
    $query=$db->prepare('SELECT COUNT (pseudo) FROM CUSTOMER WHERE mail = :mail');
    $query->bindValue(':mail',$mail, PDO::PARAM_STR);
    $query->execute();
    $count=$query->fetch();
    $query->CloseCursor();
    if($count == 1){
      return 2;
    }
    else{
      return 0;
    }
  }
}
