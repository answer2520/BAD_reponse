<?php
include "menu.php";


  // Récupérer l'identifiant du projet
  $id = $_GET['id'];

  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer la valeur du montant du formulaire
    $montant = $_POST["montant"];

    // Requête SQL pour mettre à jour le montant du projet
    $sql = "UPDATE projet SET montant='$montant' WHERE codepro='$id'";

    if ($conn->query($sql)) {
      header("Location: AffichageProjet.php");

  }
}

  // Requête SQL pour récupérer les informations du projet
  $sql = "SELECT * FROM projet WHERE codepro='$id'";

  // Exécution de la requête SQL
  $result = $conn->query($sql);

  // Vérifier si le projet existe dans la base de données
  if ($result->rowCount() > 0) {
    $row = $result->fetch();
    $nomProjet = $row['nom'];
    $montantProjet = $row['montant'];
  } 

?>

<!DOCTYPE html>
<html>
<head>
  <title>Ajouter un montant</title>
</head>
<body>
  <h1>Ajouter un montant pour le projet <?php echo $nomProjet; ?></h1>

  <form method="POST">

    <label for="montant">Montant :</label>
    <input type="text" id="montant" name="montant" required><br>

    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler">
  </form>
</body>
</html>
