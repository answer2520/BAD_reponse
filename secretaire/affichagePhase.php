
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
  
  <!-- Formulaire de recherche -->
  <!-- <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="etatRealisation">État de réalisation :</label>
    <select id="etatRealisation" name="etatRealisation">
      <option value="">Tous</option>
      <option value="Terminée">Terminée</option>
      <option value="En cours">En cours</option>
    </select>

    <label for="etatFacturation">État de facturation :</label>
    <select id="etatFacturation" name="etatFacturation">
      <option value="">Tous</option>
      <option value="Facturée">Facturée</option>
      <option value="Non facturée">Non facturée</option>
    </select>

    <label for="etatPaiement">État de paiement :</label>
    <select id="etatPaiement" name="etatPaiement">
      <option value="">Tous</option>
      <option value="Payé">Payé</option>
      <option value="Non payé">Non payé</option>
    </select>

    <input type="submit" value="Rechercher">
  </form> -->
  
  <!-- Boutons d'action -->
  <!-- <div>
    <button onclick="window.location.href='imprimer.php'">Imprimer</button>
    <button onclick="window.location.href='ajoutPhase.php'">Ajouter une phase</button>
  </div> -->
  
  <!-- Tableau des phases -->
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

    // Filtrer par état de réalisation si une valeur est sélectionnée
    if (isset($_POST['etatRealisation']) && !empty($_POST['etatRealisation'])) {
      $etatRealisation = $_POST['etatRealisation'];
      $sql .= " WHERE etatRealisation = '$etatRealisation'";
    }

    // Filtrer par état de facturation si une valeur est sélectionnée
    if (isset($_POST['etatFacturation']) && !empty($_POST['etatFacturation'])) {
      $etatFacturation = $_POST['etatFacturation'];
      if (strpos($sql, "WHERE") !== false) {
        $sql .= " AND etatFacturation = '$etatFacturation'";
      } else {
        $sql .= " WHERE etatFacturation = '$etatFacturation'";
      }
    }

    // Filtrer par état de paiement si une valeur est sélectionnée
    if (isset($_POST['etatPaiement']) && !empty($_POST['etatPaiement'])) {
      $etatPaiement = $_POST['etatPaiement'];
      if (strpos($sql, "WHERE") !== false) {
        $sql .= " AND etatPaiement = '$etatPaiement'";
      } else {
        $sql .= " WHERE etatPaiement = '$etatPaiement'";
      }
    }


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
