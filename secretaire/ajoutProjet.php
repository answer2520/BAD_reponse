<?php
include "menu.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les valeurs des champs du formulaire
  $code = $_POST["code"];
  $nom = $_POST["nom"];
  $description = $_POST["description"];
  $dateDebut = $_POST["dateDebut"];
  $dateFin = $_POST["dateFin"];
  $montant = $_POST["montant"];


  // Requête SQL pour insérer les données du projet dans la table "projet"
  $sql = "INSERT INTO projet (codepro, nom, description, dateDebut, dateFin, montant)
          VALUES ('$code', '$nom', '$description', '$dateDebut', '$dateFin', '$montant')";

  if ($conn->exec($sql)) {
    echo "Le projet a été enregistré avec succès.";
  } 
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Ajouter un projet</title>
</head>
<body>
  <h1>Ajouter un projet</h1>

  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="code">Code :</label>
    <input type="text" id="code" name="code" required><br>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="dateDebut">Date de début :</label>
    <input type="date" id="dateDebut" name="dateDebut" required><br>

    <label for="dateFin">Date de fin :</label>
    <input type="date" id="dateFin" name="dateFin" required><br>

    <label for="montant">Montant :</label>
    <input type="number" id="montant" name="montant" step="0.01" required><br>

    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler" ">
  </form>
</body>
</html>
