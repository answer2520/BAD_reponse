<?php
include "menu.php";

$id = $_GET['id'];


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les valeurs des champs du formulaire
  $code = $_POST["code"];
  $codepha = $_POST["codepha"];

  $libelle = $_POST["libelle"];
  $description = $_POST["description"];
  $cheminDocument = $_POST["cheminDocument"];



  $sql = "INSERT INTO livrable (codeli, libelle, description, cheminDocument,codepha)
          VALUES ('$code', '$libelle', '$description', '$cheminDocument','$codepha')";

  if ($conn->exec($sql)) {
      header("Location: Affichagelivrable.php");
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
  <title>Ajouter un livrable</title>
  
</head>
<body>
  <h1>Ajouter un livrable  de la phase  <?php echo $nomPhase; ?></h1>

  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

  <label for="code">Code du phase:</label>
    <input type="text" id="codepha" name="codepha" value="<?php echo $_GET['id']; ?>" readonly><br>

    <label for="code">Code :</label>
    <input type="text" id="code" name="code" required><br>

    <label for="libelle">Libelle :</label>
    <input type="text" id="libelle" name="libelle" required><br>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="">Le chemin du Document :</label>
    <input type="text" id="cheminDocument" name="cheminDocument" required><br>


    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler" ">
  </form>
</body>
</html>
