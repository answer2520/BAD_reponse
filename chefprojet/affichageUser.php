<?php
include "menu.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Affichage des utilisateurs</title>
 
</head>
<body>
  <h1>Affichage des utilisateurs</h1>
  
  <!-- Formulaire de recherche -->
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="search">Rechercher un utilisateur :</label>
    <input type="text" id="search" name="search">
    <input type="submit" value="Rechercher">
  </form>
  
  <!-- Bouton Ajouter un utilisateur -->
  <button onclick="window.location.href='ajoutUser.php'">Ajouter un utilisateur</button>
  
  <!-- Tableau des utilisateurs -->
  <table class="table">
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
    $sql = "SELECT * FROM utilisateur";

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
        echo "<td><a href='?code=".$row['matricule']."'>Supprimer</a></td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='8'>Aucun utilisateur trouvé.</td></tr>";
    }


    ?>

<?php
// Vérifier si l'identifiant de l'utilisateur est passé en paramètre
if (isset($_GET['code'])) {
  // Récupérer l'identifiant de l'utilisateur
  $id = $_GET['code'];


  // Requête SQL pour supprimer l'utilisateur de la table "utilisateur"
  $sql = "DELETE FROM utilisateur WHERE matricule = '$id'";

  if ($conn->query($sql)) {
    header("Location: affichageUser.php");

  } else {
    echo "Une erreur est survenue lors de la suppression de l'utilisateur : " . $conn->error;
  }

} 
?>

  </table>
</body>
</html>
