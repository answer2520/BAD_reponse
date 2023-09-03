<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
  <title>Banque africaine de développement</title>
  <style>
    *{
        margin: 0px;
        box-sizing: border-box;
    }
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f5f5f5;
    }
    
    .menu {
      background-color: #ffffff;
      padding: 20px;
      /* padding-left: 30%; */
      display: flex;
      justify-content: space-around;
      box-shadow: 0px 1px 5px rgba(0,0,0,0.1);
    }
    
    .menu a {
      color: #333333;
      text-decoration: none;
      padding: 10px 20px;
      font-size: 18px;
      font-weight: 500;
      border-radius: 4px;
      transition: background-color 0.2s ease;
    }
    
    .menu a:hover {
      background-color: #f2f2f2;
    }
    
    .menu a.active {
      background-color: #009959;
      color: #fff;
    }
    .logo{
      max-width: 70px;
      margin: -20px;

    }

    //////////

        /* General Styles */
        body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    h1 {
      color: #333;
      text-align: center;
      padding: 20px 0;
    }

    form {
  width: 500px;
  margin: 0 auto;
}

label {
  display: block;
  margin-bottom: 10px;
  margin-top:10px;
}

input, textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
button {
  display: flex;
}
input[type="submit"] {
  margin-top: 10px;

  background-color: #009959;
  color: white;
  padding: 15px 20px;
  border: none;
}
#description{
  height: 30px;
}
input[type="reset"] {
  margin-top: 10px;

  background-color: #009959;
  color: white;
  padding: 15px 20px;
  border: none;
  margin-bottom: 10px;

}
input[type="submit"]:hover {
  /* background-color: green; */
  cursor: pointer;  
}
input[type="reset"]:hover {
  /* background-color: green; */
  cursor: pointer;  
}
textarea {
  height: 100px;
}

    /* Styles for the buttons */
    div {
      text-align: center;
      margin-bottom: 20px;
    }

    div button {
      padding: 10px 20px;
      margin-right: 10px;
      border: none;
      background-color: #009959;
      color: white;
      cursor: pointer;
      border-radius: 5px;
    }

    /* Styles for the table */
    table {
      border-collapse: collapse;
      width: 100%;
      margin: 0 auto;
      background-color: white;
      box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
      text-align:center;
    }
    
   table th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }
    
   table th {
      background-color: #009959;
      color: white;
    }

    table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    table td a {
      color: #fff;
      font-size:13px;
      text-decoration: none;
      margin-right: 10px;
      background-color:#008A6E;
      padding:5px;
      font-weight: bolder;
      border-radius:10px;
      /* width: 50px; */
      display: inline-block; 
      /* display: flex  ;  */
      
    }

     td a:hover {
      transition:0.2s;
      transform: scale(1.1);

    }
    

  </style>
  </head>
<body>
  <div class="menu">
    <!-- <img src="../logo.jpg" alt=""> -->
  <img class="logo" src="../LogoBAD.jpeg" alt="">

    <a href="accueil.php" >Accueil</a>

    <a href="affichageOrganisme.php" >Organismes</a>
    <a href="affichageProjet.php">Projets</a>
    <a href="affichagePhase.php">Phases</a>
    <a href="affichagelivrable.php">Livrables</a>
    <a href="../deconnection.php" class="active">Deconnecter l'utilisateur: <strong><?php echo isset($_SESSION['nom_utilisateur']) ? $_SESSION['nom_utilisateur'] : 'Utilisateur'; ?></strong></a>
    <!-- <a href="affichageUser.php">Utilisateurs</a> -->
  </div>
    

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