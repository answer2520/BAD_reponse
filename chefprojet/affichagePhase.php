
<?php
include "menu.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Affichage des phases</title>
<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }
      /* Styles for the form */
      form {
      display: flex;  
      /* justify-content: center; */
      gap: 10px;
      margin-bottom: 20px;
      width: 1000px;
    }
    input[type="submit"]:hover {
  /* background-color: green; */
  cursor: pointer;  
}
input {
  height:40px;
  width:300px;

}
input[type="submit"] {
  width:100px;
  /* padding-bottom:3px; */
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



/* table td a {
      color: #fff;
      font-size:13px;
      text-decoration: none;
      margin-right: 10px;
      background-color: #009959;
      padding:5px;
      font-weight: bolder;
      border-radius:10px;

      
    }

    table  td a:hover {
      transition:0.2s;
      padding:8px;
      font-size:14px;
    } */
</style>
</head>
<body>
  <h1>Affichage des phases</h1>
  
 <!-- Formulaire de recherche -->
 <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
      <option value="Payée">Phase Payée</option>
      <option value="Non Payée">Phase Non Payée</option>
    </select>

    <input type="submit" value="Rechercher">
  </form>

  <!-- Tableau des phases -->
  <table>
    <tr>
      <th>Libellé</th>
      <th>Description</th>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>Pourcentage à payer</th>
      <th>Projet associé</th>
      <th>État de réalisation</th>
      <th>État de facturation</th>
      <th>État de paiement</th>
      <th>Action</th>
    </tr>
    <?php
    // Requête SQL de base pour récupérer les phases de la table "phase"
    $sql = "SELECT ph.codepha, ph.libelle, ph.description, ph.dateDebut, ph.dateFin, ph.pourcentageApayer, ph.etatRealisation, ph.etatFacturation, ph.etatPaiement, pr.nom AS projetAssocie
       FROM phase ph
       INNER JOIN projet pr ON ph.codepro = pr.codepro";

    // Tableau pour stocker les conditions de filtrage
    $conditions = array();

    // Filtrer par état de réalisation si une valeur est sélectionnée
    if (isset($_POST['etatRealisation']) && !empty($_POST['etatRealisation'])) {
      $etatRealisation = $_POST['etatRealisation'];
      $conditions[] = "etatRealisation = '$etatRealisation'";
    }

    // Filtrer par état de facturation si une valeur est sélectionnée
    if (isset($_POST['etatFacturation']) && !empty($_POST['etatFacturation'])) {
      $etatFacturation = $_POST['etatFacturation'];
      $conditions[] = "etatFacturation = '$etatFacturation'";
    }

    // Filtrer par état de paiement si une valeur est sélectionnée
    if (isset($_POST['etatPaiement']) && !empty($_POST['etatPaiement'])) {
      $etatPaiement = $_POST['etatPaiement'];
      $conditions[] = "etatPaiement = '$etatPaiement'";
    }

    // Si des conditions de filtrage sont spécifiées, les ajouter à la requête SQL
    if (!empty($conditions)) {
      $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    // Exécution de la requête SQL
    $result = $conn->query($sql);

    // Affichage des phases dans le tableau
    if ($result->rowCount() > 0) {
      while ($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>".$row['libelle']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td>".$row['dateDebut']."</td>";
        echo "<td>".$row['dateFin']."</td>";
        echo "<td>".$row['pourcentageApayer']."</td>";
        echo "<td>".$row['projetAssocie']."</td>";
        echo "<td>".$row['etatRealisation']."</td>";
        echo "<td>".$row['etatFacturation']."</td>";
        echo "<td>".$row['etatPaiement']."</td>";
        echo "<td>";
        echo "<a href='Cloturer.php?id=".$row['codepha']."'>Modifier l'etat d'avancement</a>";
        echo "<a href='Ajoutlivrable.php?id=".$row['codepha']."'>Ajouter un livrable</a>";
        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='10'>Aucune phase trouvée.</td></tr>";
    }
    ?>
  </table>
</body>
</html>
