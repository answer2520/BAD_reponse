<?php
include "menu.php";


  $id = $_GET['id'];

  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clo = $_POST["etatPaiement"];

    $sql = "UPDATE phase SET etatPaiement='$clo' WHERE codepha='$id'";

    if ($conn->query($sql)) {
      header("Location: AffichagePhase.php");

  }
}

  // Requête SQL pour récupérer les informations du phase
  $sql = "SELECT * FROM phase WHERE codepha='$id'";

  // Exécution de la requête SQL
  $result = $conn->query($sql);

  // Vérifier si le phase existe dans la base de données
  if ($result->rowCount() == 1) {
    $row = $result->fetch();
    $nomPhase = $row['libelle'];
  } 

?>

<!DOCTYPE html>
<html>
<head>
  <title>Phase Cloture</title>
</head>
<body>
  <h1>Facturer la phase  <?php echo $nomPhase; ?></h1>

  <form method="POST">

    <label for=""> Paiement :</label>
    <select id="etatPaiement" name="etatPaiement">
    <option value="Payée">Phase Payée</option>
      <option value="Non Payée">Phase Non Payée</option>
    </select><br>

    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler">
  </form>
</body>
</html>
