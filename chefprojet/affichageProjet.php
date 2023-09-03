<?php
include "menu.php";
// session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Affichage des projets</title>
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    h1 {
      color: #333;
      text-align: center;
      padding: 20px 0;
    }
/* ///////////////////////////////////////////////// */
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
  <h1>Affichage des projets</h1>
  
  <!-- Recherche de projet -->
  <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="nomProjet">Rechercher un projet :</label>
    <input type="text" id="nomProjet" name="nomProjet">
    <input type="submit" value="Rechercher">
    
    <a class="imp" href='imprimer_proj.php'">Imprimer le projet</a>

  </form>
  

  
  <!-- Tableau des projets -->
  <table class="table">
    <tr>
      <th>Code</th>
      <th>Nom</th>
      <th>Description</th>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>Montant</th>
      <th>organisme associé</th>
      <th>Action</th>
    </tr>
    <?php
    // Vérifier si l'utilisateur est connecté avant de récupérer les projets
    if (isset($_SESSION['matricule_chefprojet'])) {

        $sql = "SELECT p.codepro, p.nom, p.description, p.dateDebut, p.dateFin, p.montant, o.nom AS projetAssocie
        FROM projet p
        INNER JOIN organisme o ON p.codeorg = o.codeorg
        INNER JOIN chefprojet c ON p.matricule_chefprojet = c.matricule_chefprojet
        WHERE c.matricule_chefprojet = '".$_SESSION['matricule_chefprojet']."'";


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
                echo "<td>";
                echo "<a href='modifierProjet.php?id=".$row['codepro']."'>Ajouter les infos du projet</a>";
                echo "<a href='ajoutPhase1.php?id=".$row['codepro']."'>Ajouter une phase</a>";
                // echo "<a href='ajoutMontant.php?id=".$row['codepro']."'>Ajouter un montant</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Aucun projet trouvé.</td></tr>";
        }
    } 
    // else {
        
        // echo "<tr><td colspan='8'>Vous devez vous connecter en tant que chef de projet pour accéder à cette page.</td></tr>";
    // }
    ?>
  </table>
</body>
</html>
