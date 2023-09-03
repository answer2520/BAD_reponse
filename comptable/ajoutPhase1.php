<?php
include "menu.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Ajouter une phase</title>
</head>
<body>
  <h1>Ajouter une phase</h1>

  <form method="POST" >
    <label for="codeProjet">Code du projet :</label>
    <input type="text" id="codeProjet" name="codeProjet" value="<?php echo $_GET['id']; ?>" readonly><br>

    <label for="code">Code :</label>
    <input type="text" id="code" name="code" required><br>

    <label for="libelle">Libellé :</label>
    <input type="text" id="libelle" name="libelle" required><br>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="dateDebut">Date de début :</label>
    <input type="date" id="dateDebut" name="dateDebut" required><br>

    <label for="dateFin">Date de fin :</label>
    <input type="date" id="dateFin" name="dateFin" required><br>

    <label for="pourcentageApayer">Pourcentage à payer :</label>
    <input type="number" id="pourcentageApayer" name="pourcentageApayer" step="0.01" ><br>

    <label for="etatRealisation">État de réalisation :</label>
    <select id="etatRealisation" name="etatRealisation">
      <option value="En cours">En cours</option>
    </select><br>

    <label for="etatFacturation">État de facturation :</label>
    <select id="etatFacturation" name="etatFacturation">
      <option value="Non facturée">Non facturée</option>
    </select><br>

    <label for="etatPaiement">État de paiement :</label>
    <select id="etatPaiement" name="etatPaiement">
      <option value="Non Payée">Phase Non Payée</option>
    </select><br>

    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler" >
  </form>

  <?php
  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire
    $codeProjet = $_POST["codeProjet"];
    $code = $_POST["code"];
    $libelle = $_POST["libelle"];
    $description = $_POST["description"];
    $dateDebut = $_POST["dateDebut"];
    $dateFin = $_POST["dateFin"];
    $pourcentageApayer = $_POST["pourcentageApayer"];
    $etatRealisation = $_POST["etatRealisation"];
    $etatFacturation = $_POST["etatFacturation"];
    $etatPaiement = $_POST["etatPaiement"];
   

    // Requête SQL pour insérer les données de la phase dans la table "phase"
    $sql = "INSERT INTO phase (codepro, codepha, libelle, description, dateDebut, dateFin, pourcentageApayer, etatRealisation, etatFacturation, etatPaiement)
            VALUES ('$codeProjet', '$code', '$libelle', '$description', '$dateDebut', '$dateFin', '$pourcentageApayer', '$etatRealisation', '$etatFacturation', '$etatPaiement')";

    if ($conn->exec($sql)) {
      header("Location: AffichagePhase.php");
    } 
  }

  ?>
</body>
</html>
