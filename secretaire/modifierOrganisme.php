<?php
include "menu.php";

// Vérifier si l'identifiant de l'organisme est passé en paramètre
if (isset($_GET['codeorg'])) {
  // Récupérer l'identifiant de l'organisme
  $codeorg = $_GET['codeorg'];

  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire
    $code = $_POST["code"];
    $nom = $_POST["nom"];
    $adresse = $_POST["adresse"];
    $telephone = $_POST["telephone"];
    $contactNom = $_POST["contactNom"];
    $contactEmail = $_POST["contactEmail"];
    $adresseWeb = $_POST["adresseWeb"];

    // Requête SQL pour mettre à jour les informations de l'organisme
    $sql = "UPDATE organisme SET codeorg='$code', nom='$nom', adresse='$adresse', telephone='$telephone', contactNom='$contactNom', contactEmail='$contactEmail', adresseWeb='$adresseWeb' WHERE codeorg='$codeorg'";

    if ($conn->query($sql)) {
      echo "Les informations de l'organisme ont été mises à jour avec succès.";
    } else {
      echo "Une erreur est survenue lors de la mise à jour des informations de l'organisme : " . $conn->error;
    }
  }

  // Requête SQL pour récupérer les informations de l'organisme sélectionné
  $sql = "SELECT * FROM organisme WHERE codeorg='$codeorg'";

  // Exécution de la requête SQL
  $result = $conn->query($sql);

  // Vérifier si l'organisme existe dans la base de données
  if ($result->rowCount() == 1) {
    $row = $result->fetch();
    $code = $row['codeorg'];
    $nom = $row['nom'];
    $adresse = $row['adresse'];
    $telephone = $row['telephone'];
    $contactNom = $row['contactNom'];
    $contactEmail = $row['contactEmail'];
    $adresseWeb = $row['adresseWeb'];
  } else {
    echo "Organisme introuvable.";
  }
} else {
  echo "Identifiant d'organisme non spécifié.";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Modifier un organisme</title>
</head>
<body>
  <h1>Modifier un organisme</h1>

  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . '?codeorg=' . $codeorg; ?>">
    <label for="code">Code :</label>
    <input type="text" id="code" name="code" value="<?php echo isset($code) ? $code : ''; ?>" required><br>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>" required><br>

    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" value="<?php echo isset($adresse) ? $adresse : ''; ?>" required><br>

    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone" value="<?php echo isset($telephone) ? $telephone : ''; ?>" required><br>

    <label for="contactNom">Nom du contact :</label>
    <input type="text" id="contactNom" name="contactNom" value="<?php echo isset($contactNom) ? $contactNom : ''; ?>" required><br>

    <label for="contactEmail">Email du contact :</label>
    <input type="email" id="contactEmail" name="contactEmail" value="<?php echo isset($contactEmail) ? $contactEmail : ''; ?>" required><br>

    <label for="adresseWeb">Adresse web :</label>
    <input type="text" id="adresseWeb" name="adresseWeb" value="<?php echo isset($adresseWeb) ? $adresseWeb : ''; ?>" required><br>

    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler">
  </form>
</body>
</html>
