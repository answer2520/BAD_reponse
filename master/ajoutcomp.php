<?php
include "menu.php";
?>


<!DOCTYPE html>
<html>
<head>
  <title>Ajouter un comptable</title>
</head>
<body>
  <h1>Ajouter un comptable</h1>

  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="matricule">Matricule :</label>
    <input type="text" id="matricule" name="matricule" required><br>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required><br>

    <label for="telephone">Téléphone :</label>
    <input type="tel" id="telephone" name="telephone" required><br>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required><br>

    <label for="login">Login :</label>
    <input type="text" id="login" name="login" required><br>

    <label for="motDePasse">Mot de passe :</label>
    <input type="password" id="motDePasse" name="motDePasse" required><br>

    <label for="profil">Profil :</label>
    <select id="profil" name="profil" required>

      <option value="comptable">Comptable</option>
    </select><br>

    <input type="submit" value="Enregistrer">
    <input type="button" value="Annuler" >
  </form>

  <?php
  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire
    $matricule = $_POST["matricule"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $motDePasse = $_POST["motDePasse"];
    $profil = $_POST["profil"];
    $utilisateurConnecte = isset($_SESSION['nom_utilisateur']) ? $_SESSION['nom_utilisateur'] : 'Utilisateur';


    

    $sqlutilisateur = "INSERT INTO utilisateurs (matricule, nom, Prenom, telephone, email, login, motDePass, profil)
            VALUES ('$matricule', '$nom', '$prenom', '$telephone', '$email', '$login', '$motDePasse', '$profil')";

    $sqlcomptable = "INSERT INTO comptable (matricule_compt, nom, Prenom, telephone, email, login, motDePass, profil)
   VALUES ('$matricule', '$nom', '$prenom', '$telephone', '$email', '$login', '$motDePasse', '$profil')";

$sqlhisto= "INSERT INTO ajouts (Nom_ajoute, profil, ajoute_par, date_heure)
VALUES ('$nom', '$profil', '$utilisateurConnecte', NOW())";


if ($conn->query($sqlutilisateur) && $conn->query($sqlcomptable) && $conn->query($sqlhisto)) {
  header("Location: afichcomp.php");
}
  }
  ?>
</body>
</html>
