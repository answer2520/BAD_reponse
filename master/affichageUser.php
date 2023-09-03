
<?php
include "menu.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Affichage des utilisateurs</title>
  <style>
    /* Styles CSS pour le tableau */
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    
    th {
      background-color: #f2f2f2;
    }

     /* Styles for the form */
     form {
      display: flex;  
      /* justify-content: center; */
      gap: 10px;
      margin-bottom: 20px;
      width: 800px;
    }
    input[type="submit"]:hover {
  /* background-color: green; */
  cursor: pointer;  
}
input {
  height:40px;
  width:250px;

}
input[type="submit"] {
  width:100px;
}

.imp{
  text-decoration: none;
  background-color:#009959;
  color: white;
  margin-top: 10px;
  border-radius: 5px;
  padding: 15px 10px  0px 10px;
  /* justify-content: center; */
  height: 40px;
}

  </style>
  
</head>
<body>
<?php
// Vérifier si l'identifiant de l'utilisateur est passé en paramètre
if (isset($_GET['code'])) {
  // Récupérer l'identifiant de l'utilisateur
  $id = $_GET['code'];

  // Requête SQL pour récupérer les informations de l'utilisateur à supprimer
  $sqlSelect = "SELECT * FROM utilisateurs WHERE matricule = '$id'";
  $resultSelect = $conn->query($sqlSelect);

  // Vérifier si l'utilisateur existe dans la base de données
  if ($resultSelect->rowCount() == 1) {
    // Récupérer les informations de l'utilisateur
    $row = $resultSelect->fetch();
    $nom = $row['nom'];
    $prenom = $row['Prenom'];
    $telephone = $row['telephone'];
    $email = $row['email'];
    $login = $row['login'];
    $profil = $row['profil'];
    $utilisateurConnecte = isset($_SESSION['nom_utilisateur']) ? $_SESSION['nom_utilisateur'] : 'Utilisateur';

    

    // Requête SQL pour déplacer l'utilisateur dans la table "corbeille"
    $sqlCorbeille = "INSERT INTO corbeille (matriculeco, nom, Prenom, telephone, email, login, profil, date_heure_suppression, supprime_par) VALUES ('$id', '$nom', '$prenom', '$telephone', '$email', '$login', '$profil', NOW(), '$utilisateurConnecte')";

    if ($conn->query($sqlCorbeille)) {
      // Supprimer l'utilisateur de la table "utilisateurs"

  // Requête SQL pour supprimer l'utilisateur de la table "utilisateur"
  $sqlUtilisateur = "DELETE FROM utilisateurs WHERE matricule = '$id'";
  $sqlChefProjet = "DELETE FROM chefprojet WHERE matricule_chefprojet = '$id'";
  $comptable = "DELETE FROM comptable WHERE matricule_compt = '$id'";
  $secretaire = "DELETE FROM secretaire WHERE matricule_sec = '$id'";
  $directeur = "DELETE FROM directeur WHERE matricule_dir = '$id'";
  $admin = "DELETE FROM administateur WHERE matricule_adm = '$id'";

if ($conn->query($sqlUtilisateur) && $conn->query($sqlChefProjet) && $conn->query($comptable) && $conn->query($secretaire) && $conn->query($directeur) && $conn->query($admin)) {
  
    header("Location: affichageUser.php");

  } 

} 
  }
}
?>
  <h1>Affichage des utilisateurs</h1>
  
  <!-- Formulaire de recherche -->
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="search">Rechercher un utilisateur :</label>
    <input type="text" id="search" name="search">
    <input type="submit" value="Rechercher">
    <script src="script.js"></script>
  </form>
  
  <!-- Bouton Ajouter un utilisateur -->
  
  <!-- Tableau des utilisateurs -->
  <table>
    <tr>
      <th>Matricule</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Téléphone</th>
      <th>Email</th>
      <th>Login</th>
      <th>Profil</th>
      <th colspan=2>Action</th>
    </tr>
    <?php


    // Requête SQL pour récupérer les utilisateurs de la table "utilisateur"
    $sql = "SELECT * FROM utilisateurs";

    // Filtrer par nom d'utilisateur si une valeur est saisie dans le champ de recherche
    if (isset($_POST['search']) && !empty($_POST['search'])) {
      $search = $_POST['search'];
      $sql .= " WHERE nom LIKE '%$search%'";
    }

    // Exécution de la requête SQL
    $result = $conn->query($sql);

    // Affichage des utilisateurs dans le tableau
    if ($result->rowCount() > 0) {
      while ($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>".$row['matricule']."</td>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['Prenom']."</td>";
        echo "<td>".$row['telephone']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['login']."</td>";
        echo "<td>".$row['profil']."</td>";
        echo "<td><a href='modifierUser.php?matricule=".$row['matricule']."'>Modifier</a></td>";
        echo "<td><a href='#' onclick='confirmDelete(\"".$row['matricule']."\")'>Supprimer</a></td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='8'>Aucun utilisateur trouvé.</td></tr>";
    }


    ?>



  </table>
</body>
</html>