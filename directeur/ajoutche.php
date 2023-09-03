<?php
include "menu.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les valeurs des champs du formulaire
  $codepro = $_POST["codepro"];
  $codeche = $_POST["codeche"];

  // Requête SQL pour récupérer le matricule du nouveau chef de projet
  $sql = "SELECT matricule_chefprojet FROM chefprojet WHERE matricule_chefprojet='$codeche'";

  // Exécution de la requête SQL
  $result = $conn->query($sql);

  // Vérifier si le nouveau chef de projet existe dans la table "chefprojet"
  if ($result->rowCount() == 1) {
    // Requête SQL pour mettre à jour le chef de projet pour le projet spécifié
    $sql = "UPDATE projet SET matricule_chefprojet='$codeche' WHERE codepro='$codepro'";

    if ($conn->query($sql)) {
      echo "Le chef de projet a été modifié avec succès.";
      header("Location: AffichageProjet.php");
      exit;
    } else {
      echo "Une erreur s'est produite lors de la modification du chef de projet : " . $conn->error;
    }
  } else {
    echo "Le nouveau chef de projet n'a pas été trouvé dans la table 'chefprojet'.";
  }
}

// Récupérer le code du projet depuis le paramètre d'URL
if (isset($_GET['id'])) {
  $codepro = $_GET['id'];

  // Requête SQL pour récupérer les informations du projet
  $sql = "SELECT * FROM projet WHERE codepro='$codepro'";

  // Exécution de la requête SQL
  $result = $conn->query($sql);

  // Vérifier si le projet existe dans la base de données
  if ($result->rowCount() == 1) {
    $row = $result->fetch();
    $nomProjet = $row['nom'];
  } else {
    echo "Projet non trouvé.";
    exit;
  }
} else {
  echo "Code du projet non spécifié.";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Modifier le Chef de Projet pour le projet <?php echo $nomProjet; ?></title>
</head>
<body>
  <h1>Modifier le Chef de Projet pour le projet <?php echo $nomProjet; ?></h1>

  <form method="POST">
    <input type="hidden" name="codepro" value="<?php echo $codepro; ?>">
    <label for="codeche">Nouveau Chef de Projet :</label>
    <select id="codeche" name="codeche">
      <?php
        // Requête SQL pour récupérer les noms des chefs de projet
        $sql = "SELECT DISTINCT matricule_chefprojet, nom FROM chefprojet";

        // Exécution de la requête SQL
        $resultat = $conn->query($sql);

        // Affichage des options du menu déroulant avec les noms des chefs de projet
        while ($row = $resultat->fetch()) {
          $matriculeChefProjet = $row['matricule_chefprojet'];
          $nomChefProjet = $row['nom'];
          echo "<option value='$matriculeChefProjet'>$nomChefProjet</option>";
        }
      ?>
    </select><br>

    <input type="submit" value="Modifier">
    <input type="button" value="Annuler" onclick="window.location.href='AffichageProjet.php'">
  </form>
</body>
</html>
