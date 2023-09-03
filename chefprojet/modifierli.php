<?php
include "menu.php";

// Vérifier si l'identifiant du livrable est passé en paramètre
if (isset($_GET['id'])) {
  // Récupérer l'identifiant du livrable
  $id = $_GET['id'];

  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire s'ils existent dans $_POST
    $libelle = $_POST["libelle"];
    $description = $_POST["description"];
    $cheminDocument =  $_POST["cheminDocument"];

    // Requête SQL pour mettre à jour les informations du livrable
    $sql = "UPDATE livrable SET libelle='$libelle', description='$description', cheminDocument='$cheminDocument' WHERE codeli='$id'";

    if ($conn->query($sql)) {
      header("Location: Affichagelivrable.php");
    }
  }

  // Requête SQL pour récupérer les informations du livrable sélectionné
  $sql = "SELECT * FROM livrable WHERE codeli='$id'";

  // Exécution de la requête SQL
  $result = $conn->query($sql);

  // Vérifier si le livrable existe dans la base de données
  if ($result->rowCount() > 0) {
    $row = $result->fetch();
    $libelle = $row['libelle'];
    $description = $row['description'];
    $cheminDocument = $row['cheminDocument'];
  } else {
    echo "livrable introuvable.";
  }
} else {
  echo "Identifiant de livrable non spécifié.";
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Modifier un livrable</title>
</head>
<body>
  <h1>Modifier le livrable</h1>

  <form method="POST" >


    <label for="libelle">Libelle :</label>
    <input type="text" id="libelle" name="libelle" value="<?php echo isset($libelle) ? $libelle : ''; ?>" required><br>



    <label for="description">Description :</label>
<textarea id="description" name="description" required><?php echo isset($description) ? $description : ''; ?></textarea><br>


<label for="cheminDocument">Le chemin du Document :</label>
    <input id="cheminDocument" name="cheminDocument" value="<?php echo isset($cheminDocument) ? $cheminDocument : ''; ?>" required><br>


    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler">
  </form>
</body>
</html>
