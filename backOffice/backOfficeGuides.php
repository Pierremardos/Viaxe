<?php
  include '../include/config.php';
  include '../include/functions.php';
 	require_once "../include/functions.php";
  session_start();
  if($_SESSION['mail'] == 'quentin.clodion@gmail.com' | $_SESSION['mail'] =='jonasnizard@gmail.com' | $_SESSION['mail'] == 'thomas.ddt@hotmail.fr'){

  }
  else{
      header("location: backOfficeGuides.php");
      exit;
  }
	?>

<!DOCTYPE html>
<html>

        <?php
          include('../Navbar/NavbarBackOffice.php');
        ?>
      </header>
      <br>
      <br>
      <div class="container">
        <h1> Guide Manager </h1>
        <div class="row">
          <div class="col-md-6">
            <form method="POST" action="../verifInscriptionGuide.php">
              <div class="form-group w-50">
                <label>Adresse Mail :</label>
                <input type="mail" class="form-control" name="email">
                <small class="form-text text-muted"></small>
              </div>
              <div class="form-group">
               <label>Nom :</label>
               <input type="text" class="form-control w-50" name="nom">
              </div>
              <div class="form-group">
               <label>Prenom :</label>
               <input type="text" class="form-control w-50" name="prenom">
              </div>
              <div class="form-group">
               <label>Pseudo :</label>
               <input type="text" class="form-control w-50" name="pseudo">
              </div>
              <div class="form-group">
                <label>Mot de Passe :</label>
                <input type="password" class="form-control w-50" name="password">
                </div>
              <div class="form-group">
               <label>Confirmez votre mot de passe :</label>
               <input type="password" class="form-control w-50" name="confirm">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Date de naissance:</label>
                <input type="date" name="birthday" placeholder="Date de naissance">
              </div>
              <div class="form-group">
               <label>Sexe :</label>
               <input type="radio" name="gender" value="1" checked> Homme
               <input type="radio" name="gender" value="2"> Femme
             </div>
             <div class="form-group">
              <label>Langue :</label>
              <input type="text" class="form-control w-50" name="langue">
             </div>
             <div class="form-group w-50">
             <label>Pays de résidence :</label>
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
             <div class="form-group">
               <label>Numéro de téléphone (Optionnel) :</label>
               <input type="text" class="form-control w-50" name="telephone">
             </div>
             <div class="form-group">
    					 <label>Description (Optionnel) :</label>
    					 <input type="text" class="form-control w-50" name="description">
    				 </div>
             <div class="form-group">
    					 <label>Avez-vous un diplôme de guide de tourisme ? (si oui, une vérification du diplôme et d'un papier d'identité sera nécessaire)</label>
    					 <input type="radio" name="diploma" value="attente">Oui
    					 <input type="radio" name="diploma" value="vide" checked>Non
    				 </div>
              <button type="submit" class="btn btn-primary">Inscription</button>
            </form>
          </div>
        </div>
      <h1> Guide Table</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Mail</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Birth</th>
            <th scope="col">Gender</th>
            <th scope="col">Edit</th>
            <th scope="col">Ban</th>
          </tr>
        </thead>
        <?php backOfficeGuides();
        ?>
    </div>
    </body>
</html>
