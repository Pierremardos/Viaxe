<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Viaxe</title>
  </head>
  <header>
    <?php include('Navbar.php')?>
  </header>
  <body>
    <br><br><br>
<?php
// include
include 'include/config.php';    
include 'include/function.php';

//test si la personne n'est pas conecter
if ($id!=0) erreur(ERR_IS_CO);

if (!isset($_POST['pseudo']))
{
	echo '<form method="post" action="connection.php">
	<fieldset>
	<legend>Connection</legend>
	<p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
	</p>
	</fieldset>
	<p><input type="submit" value="Connection" /></p></form>
	<a href="./inscription.php">Pas encore inscrit ?</a>

	</div>
	</body>
	</html>';
}
else
{
    $message='';
    if (empty($_POST['pseudo']) || empty($_POST['password']) )
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./connection.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query=$bdd->prepare('SELECT password, id, pseudo
        FROM user WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
	if ($data['password'] == chiffer($_POST['password']))
	{
	    $_SESSION['pseudo'] = $data['pseudo'];
	    $_SESSION['id'] = $data['id'];
	    $message = '<p>Bienvenue '.$data['pseudo'].',
			vous êtes maintenant connecté!</p>
			<p>Cliquez <a href="./index.php">ici</a>
			pour revenir à la page d accueil</p>';
	}
	else // Acces pas OK !
	{
	    $message = '<p>Une erreur s\'est produite
	    pendant votre identification.<br /> Le mot de passe ou le pseudo
            entré n\'est pas correcte.</p><p>Cliquez <a href="./connection.php">ici</a>
	    pour revenir à la page précédente
	    <br /><br />Cliquez <a href="./index.php">ici</a>
	    pour revenir à la page d accueil</p>';
	}
    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}
?>



  </body>
</html>
