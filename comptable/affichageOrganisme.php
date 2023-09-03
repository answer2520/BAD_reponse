<?php
include "menu.php";
?>


<!DOCTYPE html>
<html>
<head>
  <title>Affichage des organismes</title>
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
  </style>
</head>
<body>
  <h1>Affichage des organismes</h1>
  
  <!-- <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="search">Rechercher un organisme :</label>
    <input type="text" id="search" name="asearch">
    <input type="submit" value="Rechercher">
  </form>
  
  <div>
    <button onclick="window.location.href='imprimer.php'">Imprimer</button>
    <button onclick="window.location.href='ajoutOrganisme.php'">Ajouter un organisme</button>
  </div> -->
  
  <!-- Tableau des organismes -->
  <table>
    <tr>
      <th>Code</th>
      <th>Nom</th>
      <th>Adresse</th>
      <th>Téléphone</th>
      <th>Nom du contact</th>
      <th>Email du contact</th>
      <th>Adresse web</th>
      <!-- <th>Action</th> -->

    </tr>
    <?php


    // Requête SQL pour récupérer les organismes de la table "organisme"
    $sql = "SELECT * FROM organisme";

    // Filtrer par nom d'organisme si une valeur est saisie dans le champ de recherche
    if (isset($_POST['search']) && !empty($_POST['search'])) {
      $search = $_POST['search'];
      $sql .= " WHERE nom LIKE '%$search%'";
    }

    // Exécution de la requête SQL
    $result = $conn->query($sql);

    // Affichage des organismes dans le tableau
    if ($result->rowCount() > 0) {
      while ($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>".$row['codeorg']."</td>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['adresse']."</td>";
        echo "<td>".$row['telephone']."</td>";
        echo "<td>".$row['contactNom']."</td>";
        echo "<td>".$row['contactEmail']."</td>";
        echo "<td>".$row['adresseWeb']."</td>";
        // echo "<td>";
        // echo "<a href='ajoutProjet1.php?codeorg=".$row['codeorg']."'>Ajouter un projet</a>";

        // echo "<a href='modifierOrganisme.php?codeorg=".$row['codeorg']."'>Modifier</a>";

        // echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='7'>Aucun organisme trouvé.</td></tr>";
    }

    ?>
  </table>
</body>
</html>
