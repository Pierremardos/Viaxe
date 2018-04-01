<?php
  session_start();
?>

<?php
try
{
  $bdd = new PDO('mysql:host=localhost;dbname=viaxe;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$pseudo = $_POST['pseudo'];
$mail = $_POST['email'];
$firstName = $_POST['prenom'];
$lastName = $_POST['nom'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$age = $_POST['birthday'];
$gender = $_POST['gender'];
$languages = $_POST['langue'];
$phone = $_POST['telephone'];
$description = $_POST['description'];

$req = $bdd->prepare('INSERT INTO GUIDE (mail, pseudo, firstName, lastName, age, gender, password, phone, description, languages)
 VALUES ( :mail, :pseudo, :firstName, :lastName, :age, :gender, :password, :phone, :description, :languages)');


$req->execute(array(
  "mail"=>$mail,
  "pseudo"=>$pseudo,
  "firstName"=>$firstName,
  "lastName"=>$lastName,
  "age"=>$age,
  "gender"=>$gender,
  "password"=>$password,
  "phone"=>$phone,
  "description"=>$description,
  "languages"=>$languages
  ));

header("location: index.php");

?>
