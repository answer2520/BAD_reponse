<?php
include "menu.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les valeurs des champs du formulaire
  $codepro = $_POST["codepro"];
  $codeorg = $_POST["codeorg"];
  $nomProjet = $_POST["nomProjet"];
  $description = $_POST["description"];
  $dateDebut = $_POST["dateDebut"];
  $dateFin = $_POST["dateFin"];

  // Requête SQL pour insérer un nouveau projet dans la table "projet"
  $sql = "INSERT INTO projet (codepro, codeorg, nom, description, dateDebut, dateFin) VALUES ('$codepro', '$codeorg', '$nomProjet', '$description', '$dateDebut', '$dateFin')";

  if ($conn->query($sql)) {
    echo "Le projet a été ajouté avec succès.";
    header("Location: AffichageProjet.php");
    
  } 
}

$codeorg = $_GET['codeorg'];

// Requête SQL pour récupérer les informations de l'organisme
$sql = "SELECT * FROM organisme WHERE codeorg='$codeorg'";

// Exécution de la requête SQL
$result = $conn->query($sql);

// Vérifier si l'organisme existe dans la base de données
if ($result->rowCount() == 1) {
  $row = $result->fetch();
  $nomOrganisme = $row['nom'];
} 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Ajouter un projet</title>
</head>
<body>
  <h1>Ajouter un projet pour l'organisme <?php echo $nomOrganisme; ?></h1>

  <form method="POST" >
    <input type="hidden" name="codeorg" value="<?php echo $codeorg; ?>">
    <label for="codepro">Code du projet :</label>
    <input type="text" id="codepro" name="codepro"  ><br>

    <label for="nomProjet">Nom du projet :</label>
    <input type="text" id="nomProjet" name="nomProjet"  ><br>

    <label for="description">Description :</label>
    <textarea id="description" name="description"  ></textarea><br>

    <label for="dateDebut">Date de début :</label>
    <input type="date" id="dateDebut" name="dateDebut"  ><br>

    <label for="dateFin">Date de fin :</label>
    <input type="date" id="dateFin" name="dateFin"  ><br>

    <!-- <label for="montant">Montant :</label>
    <input type="text" id="montant" name="montant"  ><br> -->

    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler">
  </form>
</body>
</html>
