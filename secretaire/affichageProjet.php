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
  <h1>Affichage des projets</h1>
  
  <!-- Recherche de projet -->
  <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="nomProjet">Rechercher un projet :</label>
    <input type="text" id="nomProjet" name="nomProjet">
    <input type="submit" value="Rechercher">
    <!-- <a class="imp" href='ajoutProjet.php'">Ajouter un projet</a> -->
    <a class="imp" href='imprimer_proj.php'">Imprimer</a>

  </form>
  
  <!-- Boutons d'action -->
  <!-- <div>
    <button onclick="window.location.href='imprimer_proj.php'">Imprimer</button>
    <button onclick="window.location.href='ajoutProjet.php'">Ajouter un projet</button>
  </div> -->
  
  <!-- Tableau des projets -->
  <table>
    <tr>
      <th>Code</th>
      <th>Nom</th>
      <th>Description</th>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>organisme associé</th>
      <th>Action</th>
    </tr>
    <?php
    
      // Requête SQL pour récupérer les organismes de la table "orgnisme"
      $sql = "SELECT p.codepro, p.nom, p.description, p.dateDebut, p.dateFin, o.nom AS projetAssocie
              FROM projet p
              INNER JOIN organisme o ON p.codeorg = o.codeorg";


                   
      // Recherche par nom de projet si une valeur est saisie
      if (isset($_GET['nomProjet']) && !empty($_GET['nomProjet'])) {
        $nomProjet = $_GET['nomProjet'];
        $sql .= " WHERE p.nom LIKE '%$nomProjet%'";
      }
    
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
          echo "<td>".$row['projetAssocie']."</td>";
          echo "<td>";
          // echo "<a href='ajoutPhase1.php?id=".$row['codepro']."'\">Ajouter une phase</a>";
          // echo "<a href='ajoutMontant.php?id=".$row['codepro']."'\">Ajouter un montant</a>";
          echo "<a href='modifierProjet.php?id=".$row['codepro']."'>Ajouter les info pour le projet</a>";
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='8'>Aucun projet trouvé.</td></tr>";
      }
    

    ?>
  </table>
</body>
</html>
