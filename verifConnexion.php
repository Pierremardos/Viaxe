<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
include('Navbar.php');
?>

<?php
    $message='';
    if (empty($_POST['pseudo']) || empty($_POST['password']) )
    {
        $message = <p>une erreur s est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="../connection.php">ici</a> pour revenir</p>;
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
	    $message = '<p>Bienvenue '.$data['pseudo'].,
			vous êtes maintenant connecté!</p>
			<p>Cliquez <a href="../index.php">ici</a>
			pour revenir à la page d accueil</p>;
	}
	else // Acces pas OK !
	{
	    $message = <p>Une erreur s est produite
	    pendant votre identification.<br /> Le mot de passe ou le pseudo
            entré n est pas correcte.</p><p>Cliquez <a href="./connection.php">ici</a>
	    pour revenir à la page précédente
	    <br /><br />Cliquez <a href="./index.php">ici</a>
	    pour revenir à la page d accueil</p>;
	}
    $query->CloseCursor();
    }
    echo $message.;
    </div></body></html>

}




  </body>
</html>
