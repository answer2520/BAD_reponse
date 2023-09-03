<?php
include "menu.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Ajouter un organisme</title>
</head>
<body>
  <h1>Ajouter un organisme</h1>

  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="code">Code :</label>
    <input type="text" id="code" name="code" required><br>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" required><br>

    <label for="telephone">Téléphone :</label>
    <input type="tel" id="telephone" name="telephone" required><br>

    <label for="contactNom">Nom du contact :</label>
    <input type="text" id="contactNom" name="contactNom" required><br>

    <label for="contactEmail">Email du contact :</label>
    <input type="email" id="contactEmail" name="contactEmail" required><br>

    <label for="adresseWeb">Adresse web :</label>
    <input type="text" id="adresseWeb" name="adresseWeb" required><br>

    <label for="adresseWeb">Origine de l'organisme :</label>
    <input type="text" id="organisme" name="organisme" required><br>

    <input type="submit" value="Enregistrer">
    <input type="button" value="Annuler" onclick="window.location.href='affichageOrganisme.php'">
  </form>

  <?php
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
    $organisme = $_POST["organisme"];


    // Requête SQL pour insérer les données de l'organisme dans la table "organisme"
    $sql = "INSERT INTO organisme (codeorg, nom, adresse, telephone, contactNom, contactEmail, adresseWeb, origine)
            VALUES ('$code', '$nom', '$adresse', '$telephone', '$contactNom', '$contactEmail', '$adresseWeb' , '$organisme')";

    if ($conn->query($sql)) {
      echo "L'organisme a été enregistré avec succès.";
    } 
  }
  ?>
</body>
</html>
