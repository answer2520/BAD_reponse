<?php
include "menu.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Affichage des Livrables</title>
 
</head>
<body>
  <h1>Affichage des Livrables</h1>
  

  <!-- Tableau des projets -->
  <table class="table">
    <tr>
      <th>Nom</th>
      <th>Description</th>
      <th>Livrable du phase:</th>
      <th>Lien du Document</th>
      <th>Action</th>
    </tr>
    <?php

// $sql = "SELECT * FROM livrable";

      $sql = "SELECT li.codeli, li.libelle, li.description, li.cheminDocument, ph.libelle AS libelleAssocie
              FROM phase ph
              INNER JOIN livrable li ON li.codepha = ph.codepha";
      

    
      // Exécution de la requête SQL
      $resultat = $conn->query($sql);
    
      // Affichage des projets dans le tableau
      if ($resultat->rowCount() > 0) {
        while ($row = $resultat->fetch()) {
          echo "<tr>";
          echo "<td>".$row['libelle']."</td>";
          echo "<td>".$row['description']."</td>";
          echo "<td>".$row['libelleAssocie']."</td>";
          echo "<td><a href='".$row['cheminDocument']."'>".$row['cheminDocument']."</a></td>";
          echo "<td>";
          echo "<a href='modifierli.php?id=".$row['codeli']."'\">Modifier le livrable</a>";
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='8'>Aucun livrable trouvé.</td></tr>";
      }
    

    ?>
  </table>
</body>
</html>
