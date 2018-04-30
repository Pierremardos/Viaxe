<?php
session_start();
include 'include/config.php';
include 'include/functions.php';
 ?>
 <?php
 if(isset($_SESSION['mail'])){

   $query=$bdd->prepare('SELECT mail
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
      include('Navbar/NavbarCustomer.php');
    }
 }
 else{
   include('Navbar/Navbar.php');
 }
 ?>

<?php
 $mail = $_SESSION['mail'];

 $query=$bdd->prepare('SELECT * FROM CUSTOMER WHERE mail = :mail');
 $query->bindValue(':mail',$mail, PDO::PARAM_STR);
 $query->execute();

 $donnees = $query->fetch();
    echo
    '<div class="py-5">
       <div class="container">
         <div class="row">
           <div class="col-md-5 order-2 order-md-1">
             <img class="img-fluid d-block" src="'.$donnees['picture'].'" width="400px"> </div>
           <div class="col-md-7 order-1 order-md-2">
             <br>Sexe : ';?>
             <?php if($donnees['gender']==1){
               echo "Homme";
             }
             else{
               echo "Femme";
             }
             ?>
             <?php echo'
             <form action="changeProfilCustomer.php" method="post" enctype="multipart/form-data">
             Mail : '.$donnees['mail'].'
             <br>Date de naissance : '.$donnees['age'].'
             <div class="form-group">
             <label>Nouvel photo de profil :</label>
             <input type="hidden" name="MAX_FILE_SIZE" value="250000">
             <input type="file" name="avatar">
             </label>
             </div>
             <div class="form-group">
                 <label>Pseudo :</label>
                 <input type="text" class="form-control w-50" name="newPseudo" value="'.$donnees['pseudo'].'">
                 <small class="form-text text-muted"></small>
             </div>
             <div class="form-group">
                 <label>Mot de passe :</label>
                 <input type="text" class="form-control w-50" name="newPassword"">
                 <small class="form-text text-muted"></small>
             </div>
             <div class="form-group">
                 <label>Mot de passe :</label>
                 <input type="text" class="form-control w-50" name="confirmNewPassword"">
                 <small class="form-text text-muted"></small>
             </div>
             <div class="form-group">
                 <label>Téléphone :</label>
                 <input type="text" class="form-control w-50" name="newPhone"" value="'.$donnees['phone'].'">
                 <small class="form-text text-muted"></small>
             </div>
             <br>
             <input type="submit" value="Valider">
             </form>
           </div>
         </div>
       </div>
     </div>';

 $query->closeCursor();
 ?>
