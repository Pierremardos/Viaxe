<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();

$now = strtotime("now") + 7160;
if(isset($_SESSION['oldNow'])){
if($_SESSION['oldNow'] < $now){
  $_SESSION['false'] = "good";
  $_SESSION['titleTrip'] = "";
  $_SESSION['departHourTrip'] = "";
  $_SESSION['departMinTrip'] = "";
  $_SESSION['countryTrip'] = "";
  $_SESSION['cityTrip'] = "";
  $_SESSION['languageTrip'] = "";
  $_SESSION['priceTrip'] = "";
  $_SESSION['placesTrip'] = "";
}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/map.css">
    <title>Créer un parcours</title>
  </head>
    <body>
    <header>
      <?php
  		if(isset($_SESSION['mail'])){

  		  $query=$bdd->prepare('SELECT *
  		  FROM GUIDE WHERE mail = :mail');
  		  $query->bindValue(':mail',$_SESSION['mail'], PDO::PARAM_STR);
  		  $query->execute();
  		  $data=$query->fetch();

        if($_SESSION['mail'] == 'quentin.clodion@gmail.com' | $_SESSION['mail'] =='jonasnizard@gmail.com' | $_SESSION['mail'] == 'thomas.ddt@hotmail.fr'){
          include('Navbar/NavbarAdmin.php');
        }
 		   else if ($_SESSION['mail'] == $data['mail'])
  		   {
  		       include('Navbar/NavbarGuide.php');
  		   }
  		   else{
           header("location: index.php");
           exit;
  		   }
  		}
  		else{
        header("location: index.php");
        exit;
  		}
      if($_GET['type']== 1 & $data['diploma'] != "ok"){
        header("location: chooseParcours.php");
        exit;
      }
  		?>
    </header>
    <main>
      <iframe class="container map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.474051746146!2d2.387545615079497!3d48.8491701093109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6720d9c7af387%3A0x5891d8d62e8535c7!2sEcole+Sup%C3%A9rieure+de+G%C3%A9nie+Informatique!5e0!3m2!1sfr!2sfr!4v1525080535212" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
      <div class="py-5">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-8 offset-md-4">
              <?php if($_GET['type']== 2){
    				echo'<form action="verifParcours.php?type=2" method="post" enctype="multipart/form-data">';
          }
            ?>
            <?php if($_GET['type']== 1){
              echo'<form action="verifParcours.php?type=1" method="post" enctype="multipart/form-data">';
            }
              ?>
    						<div class="form-group w-50">
                  <p>Pour copier le chemin de votre parcours <br>1-Sur la map cliquez en haut à gauche sur "Agrandir le plan"
                  <br>2-Cliquez sur itinéraire à gauche de la page, et mettre son chemin (il est possible de rajouter des destionations avec le petit + en bas des itinéraires)
                  <br>3-Appuyez sur le menu tout en haut à gauche et cliquez sur partagez ou intégrez la carte
                  <br>4-Aller sur intégrer une carte copier le code et le coller dans Insérer le lien</p>
    							<label>Insérer le lien :</label>
    							<input type="text" class="form-control" name="map">
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Titre :</label>
                  <?php
                  if(!isset($_SESSION['titleTrip']) | empty($_SESSION['titleTrip'])){
                  echo'
                  <input type="text" class="form-control" name="title">';
                }
                else{
                  echo'
                  <input type="text" class="form-control" name="title" value="'.$_SESSION['titleTrip'].'">';
                }?>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Photo de couverture du parcours :</label>
                  <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
                  <input type='file' name='avatar'>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Date du parcours :</label>
    							<input type="date" name="date"/>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-10">
    							<label>Heure de départ :</label>
                  <?php
                  if(!isset($_SESSION['departHourTrip']) | empty($_SESSION['departHourTrip'])){
                  echo'
                  <input type="text" name="departHour">h';
                }
                else{
                  echo'
                  <input type="text" name="departHour" value="'.$_SESSION['departHourTrip'].'">h';
                }
                ?>
                <?php
                if(!isset($_SESSION['departMinTrip']) | empty($_SESSION['departMinTrip'])){
                echo'
                  <input type="text" name="departMin">min';
                }
                else{
                  echo'
                  <input type="text" name="departMin" value="'.$_SESSION['departMinTrip'].'">min';
                }?>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-10">
    							<label>Durée du parcours :</label>
                  <input type="text" name="durationHour">h
                  <input type="text" name="durationMin">min
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Pays du parcours :</label>
                  <select name="country">
                    <option value="France" selected="selected">France </option>
                    <option value="Afghanistan">Afghanistan </option>
                    <option value="Afrique_Centrale">Afrique Centrale </option>
                    <option value="Afrique_du_sud">Afrique du Sud </option>
                    <option value="Albanie">Albanie </option>
                    <option value="Algerie">Algerie </option>
                    <option value="Allemagne">Allemagne </option>
                    <option value="Andorre">Andorre </option>
                    <option value="Angola">Angola </option>
                    <option value="Anguilla">Anguilla </option>
                    <option value="Arabie_Saoudite">Arabie Saoudite </option>
                    <option value="Argentine">Argentine </option>
                    <option value="Armenie">Armenie </option>
                    <option value="Australie">Australie </option>
                    <option value="Autriche">Autriche </option>
                    <option value="Azerbaidjan">Azerbaidjan </option>
                    <option value="Bahamas">Bahamas </option>
                    <option value="Bangladesh">Bangladesh </option>
                    <option value="Barbade">Barbade </option>
                    <option value="Bahrein">Bahrein </option>
                    <option value="Belgique">Belgique </option>
                    <option value="Belize">Belize </option>
                    <option value="Benin">Benin </option>
                    <option value="Bermudes">Bermudes </option>
                    <option value="Bielorussie">Bielorussie </option>
                    <option value="Bolivie">Bolivie </option>
                    <option value="Botswana">Botswana </option>
                    <option value="Bhoutan">Bhoutan </option>
                    <option value="Boznie_Herzegovine">Boznie Herzegovine </option>
                    <option value="Bresil">Bresil </option>
                    <option value="Brunei">Brunei </option>
                    <option value="Bulgarie">Bulgarie </option>
                    <option value="Burkina_Faso">Burkina Faso </option>
                    <option value="Burundi">Burundi </option>
                    <option value="Caiman">Caiman </option>
                    <option value="Cambodge">Cambodge </option>
                    <option value="Cameroun">Cameroun </option>
                    <option value="Canada">Canada </option>
                    <option value="Canaries">Canaries </option>
                    <option value="Cap_vert">Cap_Vert </option>
                    <option value="Chili">Chili </option>
                    <option value="Chine">Chine </option>
                    <option value="Chypre">Chypre </option>
                    <option value="Colombie">Colombie </option>
                    <option value="Comores">Colombie </option>
                    <option value="Congo">Congo </option>
                    <option value="Congo_democratique">Congo democratique </option>
                    <option value="Cook">Cook </option>
                    <option value="Coree_du_Nord">Coree du Nord </option>
                    <option value="Coree_du_Sud">Coree du Sud </option>
                    <option value="Costa_Rica">Costa Rica </option>
                    <option value="Cote_d_Ivoire">Côte d'Ivoire </option>
                    <option value="Croatie">Croatie </option>
                    <option value="Cuba">Cuba </option>
                    <option value="Danemark">Danemark </option>
                    <option value="Djibouti">Djibouti </option>
                    <option value="Dominique">Dominique </option>
                    <option value="Egypte">Egypte </option>
                    <option value="Emirats_Arabes_Unis">Emirats Arabes Unis </option>
                    <option value="Equateur">Equateur </option>
                    <option value="Erythree">Erythree </option>
                    <option value="Espagne">Espagne </option>
                    <option value="Estonie">Estonie </option>
                    <option value="Etats_Unis">Etats Unis </option>
                    <option value="Ethiopie">Ethiopie </option>
                    <option value="Falkland">Falkland </option>
                    <option value="Feroe">Feroe </option>
                    <option value="Fidji">Fidji </option>
                    <option value="Finlande">Finlande </option>
                    <option value="France">France </option>
                    <option value="Gabon">Gabon </option>
                    <option value="Gambie">Gambie </option>
                    <option value="Georgie">Georgie </option>
                    <option value="Ghana">Ghana </option>
                    <option value="Gibraltar">Gibraltar </option>
                    <option value="Grece">Grece </option>
                    <option value="Grenade">Grenade </option>
                    <option value="Groenland">Groenland </option>
                    <option value="Guadeloupe">Guadeloupe </option>
                    <option value="Guam">Guam </option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernesey">Guernesey </option>
                    <option value="Guinee">Guinee </option>
                    <option value="Guinee_Bissau">Guinee_Bissau </option>
                    <option value="Guinee equatoriale">Guinee Equatoriale </option>
                    <option value="Guyana">Guyana </option>
                    <option value="Guyane_Francaise ">Guyane Francaise </option>
                    <option value="Haiti">Haiti </option>
                    <option value="Hawaii">Hawaii </option>
                    <option value="Honduras">Honduras </option>
                    <option value="Hong_Kong">Hong Kong </option>
                    <option value="Hongrie">Hongrie </option>
                    <option value="Inde">Inde </option>
                    <option value="Indonesie">Indonesie </option>
                    <option value="Iran">Iran </option>
                    <option value="Iraq">Iraq </option>
                    <option value="Irlande">Irlande </option>
                    <option value="Islande">Islande </option>
                    <option value="Israel">Israel </option>
                    <option value="Italie">italie </option>
                    <option value="Jamaique">Jamaique </option>
                    <option value="Jan Mayen">Jan Mayen </option>
                    <option value="Japon">Japon </option>
                    <option value="Jersey">Jersey </option>
                    <option value="Jordanie">Jordanie </option>
                    <option value="Kazakhstan">Kazakhstan </option>
                    <option value="Kenya">Kenya </option>
                    <option value="Kirghizstan">Kirghizistan </option>
                    <option value="Kiribati">Kiribati </option>
                    <option value="Koweit">Koweit </option>
                    <option value="Laos">Laos </option>
                    <option value="Lesotho">Lesotho </option>
                    <option value="Lettonie">Lettonie </option>
                    <option value="Liban">Liban </option>
                    <option value="Liberia">Liberia </option>
                    <option value="Liechtenstein">Liechtenstein </option>
                    <option value="Lituanie">Lituanie </option>
                    <option value="Luxembourg">Luxembourg </option>
                    <option value="Lybie">Lybie </option>
                    <option value="Macao">Macao </option>
                    <option value="Macedoine">Macedoine </option>
                    <option value="Madagascar">Madagascar </option>
                    <option value="Madère">Madère </option>
                    <option value="Malaisie">Malaisie </option>
                    <option value="Malawi">Malawi </option>
                    <option value="Maldives">Maldives </option>
                    <option value="Mali">Mali </option>
                    <option value="Malte">Malte </option>
                    <option value="Man">Man </option>
                    <option value="Mariannes du Nord">Mariannes du Nord </option>
                    <option value="Maroc">Maroc </option>
                    <option value="Marshall">Marshall </option>
                    <option value="Martinique">Martinique </option>
                    <option value="Maurice">Maurice </option>
                    <option value="Mauritanie">Mauritanie </option>
                    <option value="Mayotte">Mayotte </option>
                    <option value="Mexique">Mexique </option>
                    <option value="Micronesie">Micronesie </option>
                    <option value="Midway">Midway </option>
                    <option value="Moldavie">Moldavie </option>
                    <option value="Monaco">Monaco </option>
                    <option value="Mongolie">Mongolie </option>
                    <option value="Montserrat">Montserrat </option>
                    <option value="Mozambique">Mozambique </option>
                    <option value="Namibie">Namibie </option>
                    <option value="Nauru">Nauru </option>
                    <option value="Nepal">Nepal </option>
                    <option value="Nicaragua">Nicaragua </option>
                    <option value="Niger">Niger </option>
                    <option value="Nigeria">Nigeria </option>
                    <option value="Niue">Niue </option>
                    <option value="Norfolk">Norfolk </option>
                    <option value="Norvege">Norvege </option>
                    <option value="Nouvelle_Caledonie">Nouvelle Caledonie </option>
                    <option value="Nouvelle_Zelande">Nouvelle Zelande </option>
                    <option value="Oman">Oman </option>
                    <option value="Ouganda">Ouganda </option>
                    <option value="Ouzbekistan">Ouzbekistan </option>
                    <option value="Pakistan">Pakistan </option>
                    <option value="Palau">Palau </option>
                    <option value="Palestine">Palestine </option>
                    <option value="Panama">Panama </option>
                    <option value="Papouasie_Nouvelle_Guinee">Papouasie Nouvelle Guinee </option>
                    <option value="Paraguay">Paraguay </option>
                    <option value="Pays_Bas">Pays_Bas </option>
                    <option value="Perou">Perou </option>
                    <option value="Philippines">Philippines </option>
                    <option value="Pologne">Pologne </option>
                    <option value="Polynesie">Polynesie </option>
                    <option value="Porto_Rico">Porto Rico </option>
                    <option value="Portugal">Portugal </option>
                    <option value="Qatar">Qatar </option>
                    <option value="Republique_Dominicaine">Republique Dominicaine </option>
                    <option value="Republique_Tcheque">Republique Tcheque </option>
                    <option value="Reunion">Reunion </option>
                    <option value="Roumanie">Roumanie </option>
                    <option value="Royaume_Uni">Royaume Uni </option>
                    <option value="Russie">Russie </option>
                    <option value="Rwanda">Rwanda </option>
                    <option value="Sahara Occidental">Sahara Occidental </option>
                    <option value="Sainte_Lucie">Sainte Lucie </option>
                    <option value="Saint_Marin">Saint Marin </option>
                    <option value="Salomon">Salomon </option>
                    <option value="Salvador">Salvador </option>
                    <option value="Samoa_Occidentales">Samoa Occidentales</option>
                    <option value="Samoa_Americaine">Samoa Americaine </option>
                    <option value="Sao_Tome_et_Principe">Sao Tome et Principe </option>
                    <option value="Senegal">Senegal </option>
                    <option value="Seychelles">Seychelles </option>
                    <option value="Sierra Leone">Sierra Leone </option>
                    <option value="Singapour">Singapour </option>
                    <option value="Slovaquie">Slovaquie </option>
                    <option value="Slovenie">Slovenie</option>
                    <option value="Somalie">Somalie </option>
                    <option value="Soudan">Soudan </option>
                    <option value="Sri_Lanka">Sri Lanka </option>
                    <option value="Suede">Suede </option>
                    <option value="Suisse">Suisse </option>
                    <option value="Surinam">Surinam </option>
                    <option value="Swaziland">Swaziland </option>
                    <option value="Syrie">Syrie </option>
                    <option value="Tadjikistan">Tadjikistan </option>
                    <option value="Taiwan">Taiwan </option>
                    <option value="Tonga">Tonga </option>
                    <option value="Tanzanie">Tanzanie </option>
                    <option value="Tchad">Tchad </option>
                    <option value="Thailande">Thailande </option>
                    <option value="Tibet">Tibet </option>
                    <option value="Timor_Oriental">Timor Oriental </option>
                    <option value="Togo">Togo </option>
                    <option value="Trinite_et_Tobago">Trinite et Tobago </option>
                    <option value="Tristan da cunha">Tristan de cuncha </option>
                    <option value="Tunisie">Tunisie </option>
                    <option value="Turkmenistan">Turmenistan </option>
                    <option value="Turquie">Turquie </option>
                    <option value="Ukraine">Ukraine </option>
                    <option value="Uruguay">Uruguay </option>
                    <option value="Vanuatu">Vanuatu </option>
                    <option value="Vatican">Vatican </option>
                    <option value="Venezuela">Venezuela </option>
                    <option value="Vierges_Americaines">Vierges Americaines </option>
                    <option value="Vierges_Britanniques">Vierges Britanniques </option>
                    <option value="Vietnam">Vietnam </option>
                    <option value="Wake">Wake </option>
                    <option value="Wallis et Futuma">Wallis et Futuma </option>
                    <option value="Yemen">Yemen </option>
                    <option value="Yougoslavie">Yougoslavie </option>
                    <option value="Zambie">Zambie </option>
                    <option value="Zimbabwe">Zimbabwe </option>
                  </select>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Ville du parcours :</label>
                  <?php
                if(!isset($_SESSION['cityTrip']) | empty($_SESSION['cityTrip'])){
                  echo'
    							<input type="text" name="city"/>';
                }
                else{
                  echo'
                  <input type="text" name="city" value="'.$_SESSION['cityTrip'].'"/>';
                }?>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Langues utilisés :</label>
                  <?php
                if(!isset($_SESSION['languageTrip']) | empty($_SESSION['languageTrip'])){
                  echo'
    							<input type="text" name="language"/>';
                }
                else{
                  echo'
                  <input type="text" name="language" value="'.$_SESSION['languageTrip'].'"/>';
                }?>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
    							<label>Prix par client :</label>
                  <?php
                if(!isset($_SESSION['priceTrip']) | empty($_SESSION['priceTrip'])){
                  echo'
    							<input type="text" name="price"/>';
                }
                else{
                  echo'
                  <input type="text" name="price" value="'.$_SESSION['priceTrip'].'"/>';
                }?>
    							<small class="form-text text-muted"></small>
    						</div>
                <div class="form-group w-50">
                  <label>Places disponibles :</label>
                  <?php
                if(!isset($_SESSION['placesTrip']) | empty($_SESSION['placesTrip'])){
                  echo'
                  <input type="text" name="place"/>';
                }
                else{
                  echo'
                  <input type="text" name="place" value="'.$_SESSION['placesTrip'].'"/>';
                }?>
                  <small class="form-text text-muted"></small>
                </div>
      <p>
      Une réduction peut être appliqué à partir d'une certaine date afin de remplir les places vacantes du parcours.
      Si cela ne vous interesse pas laissez les champs vides.
      </p>
      <div class="form-group w-50">
        <label>Date et heure d'application de la réduction :</label>
        <input type="date" name="finalDate"/>
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-10">
        <label>Heure d'application de la réduction :</label>
        <input type="text" name="finalHour">h
        <input type="text" name="finalMin">min
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-10">
        <label>Prix appliqué à la réduction :</label>
        <input type="text" name="finalPrice">
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Photo 1 de la description du parcours :</label>
        <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
        <input type='file' name='avatar1'>
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Présentation associé à la photo :</label>
        <input type="text" name="content">
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Photo 2 de la description du parcours :</label>
        <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
        <input type='file' name='avatar2'>
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Présentation associé à la photo :</label>
        <input type="text" name="content2">
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Photo 3 de la description du parcours :</label>
        <input type='hidden' name='MAX_FILE_SIZE' value='250000'>
        <input type='file' name='avatar3'>
        <small class="form-text text-muted"></small>
      </div>
      <div class="form-group w-100">
        <label>Présentation associé à la photo :</label>
        <input type="text" name="content3">
        <small class="form-text text-muted"></small>
      </div>
      <?php
      $_SESSION['type'] = $_GET['type'];
        ?>
      <input type="submit" value="Créer">
    </form>
  </main>
  </body>
</html>
