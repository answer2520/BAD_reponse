

<!DOCTYPE html>
<html>
<head>
  <title>Impression des projets</title>
  <style>
    body {
  font-family: 'Roboto', sans-serif;
  background-color: #f5f5f5;
}

    /* Styles CSS pour l'impression */
    @media print {
      .no-print {
        display: none;
      }
    }
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

/* .no-print{
      display: flex;
      justify-content: center;
} */
h1{
  text-align: center;
}
button{
    border: none;
    color: white;
    padding :15px;
    margin-bottom: 20px;
    margin-left: 20px;
    border-radius: 10px;
    width : 100px;
  font-size: 15px;
  font-weight: bold;
  cursor: pointer;
    /* display: flex; */
    /* justify-items: center; */
    background-color: #009959;
  }
  </style>
</head>
<body>

  <!-- Bouton d'impression et de retour -->
  <div class="no-print">
  <h1>Impression des projets</h1>

    <button class="button" onclick="window.print()">Imprimer</button>
    <button onclick="window.location.href='affichageProjet.php'">Retour</button>
  </div>

  <!-- Tableau des projets (copié depuis la page affichageProjet.php) -->
  <table>
    <tr>
      <th>Code</th>
      <th>Nom</th>
      <th>Description</th>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>Montant</th>
    </tr>
    <?php


$adressServeur ="localhost";
$nomUtilisateur ="root";
$motDePasse ="";
$nomBD ="bad";
$conn = new PDO("mysql:host=$adressServeur;dbname=$nomBD", $nomUtilisateur, $motDePasse);

    // Requête SQL pour récupérer les projets de la table "projet"
    $sql = "SELECT * FROM projet";

    // Exécution de la requête SQL
    $result = $conn->query($sql);

    // Affichage des projets dans le tableau
    if ($result->rowCount() > 0) {
      while ($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>".$row['codepro']."</td>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td>".$row['dateDebut']."</td>";
        echo "<td>".$row['dateFin']."</td>";
        echo "<td>".$row['montant']."</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='6'>Aucun projet trouvé.</td></tr>";
    }

    ?>
  </table>
</body>
</html>
