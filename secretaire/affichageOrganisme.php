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
  <h1>Affichage des organismes</h1>
  
  <!-- Formulaire de recherche -->
  <form method="POST" >
    <label for="search">Rechercher un organisme :</label>
    <input type="text" id="search" name="search">
    <input type="submit" value="Rechercher">
    <a class="imp" href='ajoutOrganisme.php'">Ajouter un organisme</a>

  </form>
  
  <!-- Boutons d'action -->
  <div>
    <!-- <button onclick="window.location.href='ajoutOrganisme.php'">Ajouter un organisme</button> -->
  </div>
  
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
      <th>origine orga</th>
      <th>Action</th>

    </tr>
    <?php


    // Requête SQL pour récupérer les organismes de la table "organisme"
    $sql = "SELECT * FROM organisme";

    // Filtrer par nom d'organisme si une valeur est saisie dans le champ de recherche
    if (isset($_POST['search'])) {
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
        echo "<td>".$row['origine']."</td>";
        echo "<td>";
        // echo "<a href='ajoutProjet1.php?codeorg=".$row['codeorg']."'>Ajouter un projet</a>";

        echo "<a href='modifierOrganisme.php?codeorg=".$row['codeorg']."'>Modifier l'organisme </a>";

        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='7'>Aucun organisme trouvé.</td></tr>";
    }

    ?>
  </table>
</body>
</html>
