<?php
include "menu.php";

// Vérifier si l'identifiant du projet est passé en paramètre
if (isset($_GET['id'])) {
  // Récupérer l'identifiant du projet
  $id = $_GET['id'];

  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire
    $code = $_POST["code"];
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $dateDebut = $_POST["dateDebut"];
    $dateFin = $_POST["dateFin"];

    // Requête SQL pour mettre à jour les informations du projet
    $sql = "UPDATE projet SET codepro='$code', nom='$nom', description='$description', dateDebut='$dateDebut', dateFin='$dateFin' WHERE codepro='$id'";

    if ($conn->query($sql)) {
      header("Location: AffichageProjet.php");

    } else {
      echo "Une erreur est survenue lors de la mise à jour des informations du projet : " . $conn->error;
    }
  }

  // Requête SQL pour récupérer les informations du projet sélectionné
  $sql = "SELECT * FROM projet WHERE codepro='$id'";

  // Exécution de la requête SQL
  $result = $conn->query($sql);

  // Vérifier si le projet existe dans la base de données
  if ($result->rowCount() == 1) {
    $row = $result->fetch();
    $code = $row['codepro'];
    $nom = $row['nom'];
    $description = $row['description'];
    $dateDebut = $row['dateDebut'];
    $dateFin = $row['dateFin'];
  } else {
    echo "Projet introuvable.";
  }
} else {
  echo "Identifiant de projet non spécifié.";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Modifier un projet</title>
</head>
<body>
  <h1>Modifier un projet</h1>

  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . '?id=' . $id; ?>">
    <label for="code">Code :</label>
    <input type="text" id="code" name="code" value="<?php echo isset($code) ? $code : ''; ?>" required><br>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>" required><br>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required><?php echo isset($description) ? $description : ''; ?></textarea><br>

    <label for="dateDebut">Date de début :</label>
    <input type="date" id="dateDebut" name="dateDebut" value="<?php echo isset($dateDebut) ? $dateDebut : ''; ?>" required><br>

    <label for="dateFin">Date de fin :</label>
    <input type="date" id="dateFin" name="dateFin" value="<?php echo isset($dateFin) ? $dateFin : ''; ?>" required><br>

    <!-- <label for="montant">Montant :</label>
    <input type="number" id="montant" name="montant" step="0.01" value="<?php echo isset($montant) ? $montant : ''; ?>" required><br> -->

    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler">
  </form>
</body>
</html>
