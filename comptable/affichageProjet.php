<?php
include "menu.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Affichage des projets</title>
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
  <h1>Affichage des projets</h1>
  
 
  
  <!-- Tableau des projets -->
  <table>
    <tr>
      <th>Code</th>
      <th>Nom</th>
      <th>Description</th>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>Montant</th>
      <th>organisme associé</th>
      <!-- <th>Action</th> -->
    </tr>
    <?php

    
      // Requête SQL pour récupérer les projets de la table "projet"
      $sql = "SELECT p.codepro, p.nom, p.description, p.dateDebut, p.dateFin, p.montant, o.nom AS projetAssocie
              FROM projet p
              INNER JOIN organisme o ON p.codeorg = o.codeorg";
      
 
    
      // Exécution de la requête SQL
      $resultat = $conn->query($sql);
    
      // Affichage des projets dans le tableau
      if ($resultat->rowCount() > 0) {
        while ($row = $resultat->fetch()) {
          echo "<tr>";
          echo "<td>".$row['codepro']."</td>";
          echo "<td>".$row['nom']."</td>";
          echo "<td>".$row['description']."</td>";
          echo "<td>".$row['dateDebut']."</td>";
          echo "<td>".$row['dateFin']."</td>";
          echo "<td>".$row['montant']."</td>";
          echo "<td>".$row['projetAssocie']."</td>";
          // echo "<td>";
          // echo "<a href='ajoutPhase1.php?id=".$row['codepro']."'\">Ajouter une phase</a>";
          // echo "<a href='ajoutMontant.php?id=".$row['codepro']."'\">Ajouter un montant</a>";
          // echo "<a href='modifierProjet.php?id=".$row['codepro']."'>Modifier</a>";
          // echo "</td>";
          echo "</tr>";
        }
      } 
    

    ?>
  </table>
</body>
</html>
