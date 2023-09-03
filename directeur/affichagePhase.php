
<?php
include "menu.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Affichage des phases</title>
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
  <h1>Affichage des phases</h1>
  

  

  
  <table>
    <tr>
      <!-- <th>Code</th> -->
      <th>Libellé</th>
      <th>Description</th>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>Pourcentage à payer</th>
      <th>Projet associé</th>
      <th>État de réalisation</th>
      <th>État de facturation</th>
      <th>État de paiement</th>
      <!-- <th>Action</th> -->
    </tr>
    <?php


    // Requête SQL pour récupérer les phases de la table "phase"
    $sql = "SELECT * FROM phase";



       // Requête SQL pour récupérer les phases de la table "phase"
       $sql = "SELECT ph.codepha, ph.libelle, ph.description, ph.dateDebut, ph.dateFin, ph.pourcentageApayer, ph.etatRealisation, ph.etatFacturation, ph.etatPaiement, pr.nom AS projetAssocie
       FROM phase ph
       INNER JOIN projet pr ON ph.codepro = pr.codepro";


    // Exécution de la requête SQL
    $result = $conn->query($sql);

    // Affichage des phases dans le tableau
    if ($result->rowCount() > 0) {
      while ($row = $result->fetch()) {
        echo "<tr>";
        // echo "<td>".$row['codepha']."</td>";
        echo "<td>".$row['libelle']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td>".$row['dateDebut']."</td>";
        echo "<td>".$row['dateFin']."</td>";
        echo "<td>".$row['pourcentageApayer']."</td>";
        echo "<td>".$row['projetAssocie']."</td>";
        echo "<td>".$row['etatRealisation']."</td>";
        echo "<td>".$row['etatFacturation']."</td>";
        echo "<td>".$row['etatPaiement']."</td>";
        // echo "<td>";
        //   echo "<a href='Cloturer.php?id=".$row['codepha']."'\">Modifier l'etat d'avancement</a>";
        //   echo "<a href='Facturer.php?id=".$row['codepha']."'\">Facturer</a>";
        //   echo "<a href='Payer.php?id=".$row['codepha']."'\">Payer</a>";
        //   echo "<a href='Ajoutlivrable.php?id=".$row['codepha']."'\">Ajouter un livrable</a>";

        // echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='10'>Aucune phase trouvée.</td></tr>";
    }


    ?>
  </table>
</body>
</html>
