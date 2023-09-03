<?php
include "menu.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Affichage des secretaires</title>
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
  <h1>Affichage des secretaires</h1>
  
  <!-- Formulaire de recherche -->
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="search">Rechercher un secretaire :</label>
    <input type="text" id="search" name="search">
    <input type="submit" value="Rechercher">
    <a class="imp" href="ajoutsecr.php">Ajouter un secretaire</a>

  </form>
  
  <!-- Bouton Ajouter un secretaire -->
  
  <!-- Tableau des secretaires -->
  <table>
    <tr>
      <th>Matricule</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Téléphone</th>
      <th>Email</th>
      <th>Login</th>
      <th>Profil</th>
    </tr>
    <?php


    // Requête SQL pour récupérer les secretaires de la table "secretaire"
    $sql = "SELECT * FROM secretaire";

    // Filtrer par nom d'secretaire si une valeur est saisie dans le champ de recherche
    if (isset($_POST['search']) && !empty($_POST['search'])) {
      $search = $_POST['search'];
      $sql .= " WHERE nom LIKE '%$search%'";
    }

    // Exécution de la requête SQL
    $result = $conn->query($sql);

    // Affichage des secretaires dans le tableau
    if ($result->rowCount() > 0) {
      while ($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>".$row['matricule_sec']."</td>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['Prenom']."</td>";
        echo "<td>".$row['telephone']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['login']."</td>";
        echo "<td>".$row['profil']."</td>";

        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='8'>Aucun secretaire trouvé.</td></tr>";
    }


    ?>



  </table>
</body>
</html>
