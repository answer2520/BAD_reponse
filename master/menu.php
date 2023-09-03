<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
  <title>Banque africaine de développement</title>
  <link rel="stylesheet" href="style.css">
 
</head>
<body>
  <div class="menu">
   
  <img class="logo" src="../LogoBAD.jpeg" alt="">

   <div class="sub-menu-container">
      <a href="accueil.php" >Accueil</a>
      <!-- <div class="user-name">Bonjour <?php echo isset($_SESSION['nom_utilisateur']) ? $_SESSION['nom_utilisateur'] : 'Utilisateur'; ?></div> -->

     <a href="#" onmouseover="displaySubMenu(true)" onmouseout="displaySubMenu(false)">Utilisateurs</a>
     <div id="subMenu" onmouseover="displaySubMenu(true)" onmouseout="displaySubMenu(false)">
       <a href="affichageUser.php">Tous les utilisateurs</a>
       <a href="afichdir.php">Directeur</a>
       <a href="afichadmin.php">Administrateur</a>
       <a href="afichachef.php">Chef de projet</a>
       <a href="afichcomp.php">Comptable</a>
       <a href="afichsecr.php">Secrétaire</a>
     </div>

     <a href="#" onmouseover="displaySubMenu1(true)" onmouseout="displaySubMenu1(false)">Historique</a>
     <div id="subMenu1" onmouseover="displaySubMenu1(true)" onmouseout="displaySubMenu1(false)">
     <a href="usersupprimer.php">Corbeille</a> 
     <a href="modification.php">Modifications</a> 
     <a href="ajout_user_historique.php">Ajouts</a> 
     </div>


   <a href="../deconnection.php" class="active">Deconnecter l'utilisateur: <strong><?php echo isset($_SESSION['nom_utilisateur']) ? $_SESSION['nom_utilisateur'] : 'Utilisateur'; ?></strong></a>

   </div>
 </div>
  
  <script>
    function displaySubMenu(show) {
      var subMenu = document.getElementById('subMenu');
      subMenu.style.display = show ? 'block' : 'none';
    }

    function displaySubMenu1(shown) {
      var subMenu1 = document.getElementById('subMenu1');
      subMenu1.style.display = shown ? 'block' : 'none';
    }
  </script>
</body>
</html>
<?php
$dsn = 'mysql:host=localhost;dbname=bad;charset=utf8mb4';
$username = 'root';
$password = '';

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}


    // $adressServeur ="localhost";
    // $nomUtilisateur ="root";
    // $motDePasse ="";
    // $nomBD ="bad";
    // $conn = new PDO("mysql:host=$adressServeur;dbname=$nomBD", $nomUtilisateur, $motDePasse);
?>