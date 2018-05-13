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
  $query = $db->prepare("SELECT mail,pseudo,age,gender,isBanned FROM customer WHERE isBanned = 0");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){

    echo'
    <tr>
        <form method="GET" action="edit.php">
          <td><input name="mail" type="text" value="'.$member["mail"].'"/></td>
          <td><input name="pseudo" type="text" value="'.$member["pseudo"].'"/></td>
          <td><input name="age" type="text" value="'.$member["age"].'"/></td>
          <td><input name="gender" type="text" value="'.$member["gender"].'"/></td>
          <td>
          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
        </td>
        ';

      echo'
      <td>
        <form method="GET" action="ban.php">
          <input  name="mail" type="hidden" value="'.$member["mail"].'"/>
          <button type="submit" class="btn btn-danger">
            <span class="glyphicon glyphicon-remove-circle"></span>
          </button>
        </form>
      </td>
    </tr>
    ';

  }
}

function backOfficeGuides(){
  $db = connectDb();
  $query = $db->prepare("SELECT mail,pseudo,age,gender,isBanned FROM guide WHERE isBanned = 0");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){

    echo'
    <tr>
        <form method="GET" action="editGuide.php">
          <td><input name="mail" type="text" value="'.$member["mail"].'"/></td>
          <td><input name="pseudo" type="text" value="'.$member["pseudo"].'"/></td>
          <td><input name="age" type="text" value="'.$member["age"].'"/></td>
          <td><input name="gender" type="text" value="'.$member["gender"].'"/></td>
          <td>
          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
        </td>
        ';

      echo'
      <td>
        <form method="GET" action="banGuide.php">
          <input  name="mail" type="hidden" value="'.$member["mail"].'"/>
          <button type="submit" class="btn btn-danger">
            <span class="glyphicon glyphicon-remove-circle"></span>
          </button>
        </form>
      </td>
    </tr>
    ';
  }
}

function showBannedCustomer(){
  $db = connectDb();
  $query = $db->prepare("SELECT mail, pseudo, age, gender FROM customer WHERE isBanned = 1");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
      <td>'.$member["mail"].'</td>
      <td>'.$member["pseudo"].'</td>
      <td>'.$member["age"].'</td>
      <td>'.$member["gender"].'</td>
    ';
    echo'
    <td>
      <form method="GET" action="unban.php">
        <input  name="mail" type="hidden" value="'.$member["mail"].'"/>
        <button type="submit" class="btn btn-danger">
          <span class="glyphicon glyphicon-remove-circle"></span>
        </button>
      </form>
    </td>
  </tr>
  ';
  }
}

function showBannedGuides(){
  $db = connectDb();
  $query = $db->prepare("SELECT mail, pseudo, age, gender FROM guide WHERE isBanned = 1");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
      <td>'.$member["mail"].'</td>
      <td>'.$member["pseudo"].'</td>
      <td>'.$member["age"].'</td>
      <td>'.$member["gender"].'</td>
    ';
    echo'
    <td>
      <form method="GET" action="unbanGuide.php">
        <input  name="mail" type="hidden" value="'.$member["mail"].'"/>
        <button type="submit" class="btn btn-danger">
          <span class="glyphicon glyphicon-remove-circle"></span>
        </button>
      </form>
    </td>
  </tr>
  ';
  }

}

function banUser($mail){
  $db = connectDb();
  $query = $db->prepare("UPDATE customer SET isBanned = 1 WHERE mail = :mail");
  $query->execute(["mail"=>$mail]);
}

function banGuide($mail){
  $db = connectDb();
  $query = $db->prepare("UPDATE guide SET isBanned = 1 WHERE mail =:mail");
  $query->execute(["mail"=>$mail]);
}

function unbanUser($mail){
  $db = connectDb();
  $query = $db->prepare("UPDATE customer SET isBanned = 0 WHERE mail = :mail");
  $query->execute(["mail"=>$mail]);
}

function unbanGuide($mail){
  $db = connectDb();
  $query = $db->prepare("UPDATE guide SET isBanned = 0 WHERE mail = :mail");
  $query->execute(["mail"=>$mail]);
}

function editUser($mail, $pseudo, $age, $gender){
  $db = connectDb();
  $query = $db->prepare("UPDATE customer SET mail = :mail, pseudo = :pseudo, age = :age, gender = :gender WHERE mail = :mail");
  $query->execute([
                  "mail"=>$mail,
                  "pseudo"=>$pseudo,
                  "age"=>$age,
                  "gender"=>$gender,
                  "isBanned"=>$isBanned,
                  ]);
}

function editGuide($mail, $pseudo, $age, $gender){
  $db = connectDb();
  $query = $db->prepare("UPDATE guide SET mail = :mail, pseudo = :pseudo, age = :age, gender = :gender WHERE mail = :mail");
  $query->execute([
                  "mail"=>$mail,
                  "pseudo"=>$pseudo,
                  "age"=>$age,
                  "gender"=>$gender,
                  "isBanned"=>$isBanned,
                  ]);
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

function resetPlaces($id){
  $db = connectDb();
  $query=$db->prepare('UPDATE TRIP SET places = 0 WHERE id = :id');
  $query->bindValue(':id',$id, PDO::PARAM_STR);
  $query->execute();
}
