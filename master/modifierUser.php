<?php
include "menu.php";
?>
<?php
// Vérifier si l'identifiant de l'utilisateur est passé en paramètre
if (isset($_GET['matricule'])) {
  // Récupérer l'identifiant de l'utilisateur
  $matricule = $_GET['matricule'];

  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $motDePasse = $_POST["motDePasse"];
    // $profil = $_POST["profil"];
    $utilisateurConnecte = isset($_SESSION['nom_utilisateur']) ? $_SESSION['nom_utilisateur'] : 'Utilisateur';

    // Requête SQL pour mettre à jour les informations de l'utilisateur
    $sql = "UPDATE utilisateurs SET nom='$nom', Prenom='$prenom', telephone='$telephone', email='$email', login='$login', motDePass='$motDePasse'  WHERE matricule='$matricule'";

    $sqladm = "UPDATE administateur SET nom='$nom', Prenom='$prenom', telephone='$telephone', email='$email', login='$login', motDePass='$motDePasse'  WHERE matricule_adm='$matricule'";

    $sqlche = "UPDATE chefprojet SET nom='$nom', Prenom='$prenom', telephone='$telephone', email='$email', login='$login', motDePass='$motDePasse'  WHERE matricule_chefprojet='$matricule'";

    $sqlco = "UPDATE comptable SET nom='$nom', Prenom='$prenom', telephone='$telephone', email='$email', login='$login', motDePass='$motDePasse'  WHERE matricule_compt='$matricule'";

    $sqlse = "UPDATE secretaire SET nom='$nom', Prenom='$prenom', telephone='$telephone', email='$email', login='$login', motDePass='$motDePasse'  WHERE matricule_sec='$matricule'";

    $sqldi = "UPDATE directeur SET nom='$nom', Prenom='$prenom', telephone='$telephone', email='$email', login='$login', motDePass='$motDePasse'  WHERE matricule_dir='$matricule'";

    if ($conn->query($sql) && $conn->query($sqladm) && $conn->query($sqlche) && $conn->query($sqlco) && $conn->query($sqlse) && $conn->query($sqldi)) {
      // Requête SQL pour enregistrer la modification
      $modi = "INSERT INTO modification (Modification_des_infos_de, Modifie_par, Date_heure_de_la_modification) VALUES ('$nom','$utilisateurConnecte',NOW())";
      if ($conn->query($modi)) {
        header("Location: affichageUser.php");
      } 
    }
  }

  // Requête SQL pour récupérer les informations de l'utilisateur sélectionné
  $sql = "SELECT * FROM utilisateurs WHERE matricule='$matricule'";

  // Exécution de la requête SQL
  $result = $conn->query($sql);

  // Vérifier si l'utilisateur existe dans la base de données
  if ($result->rowCount() == 1) {
    $row = $result->fetch();
    $nom = $row['nom'];
    $prenom = $row['Prenom'];
    $telephone = $row['telephone'];
    $email = $row['email'];
    $login = $row['login'];
    $motDePasse = $row['motDePass'];
    $profil = $row['profil'];
  } 
} 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Modifier un utilisateur</title>
</head>
<body>
  <h1>Modifier un utilisateur</h1>

  <form method="POST" action="">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo isset($prenom) ? $prenom : ''; ?>" required><br>

    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone" value="<?php echo isset($telephone) ? $telephone : ''; ?>" required><br>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required><br>

    <label for="login">Login :</label>
    <input type="text" id="login" name="login" value="<?php echo isset($login) ? $login : ''; ?>" required><br>

    <label for="motDePasse">Mot de passe :</label>
    <input type="password" id="motDePasse" name="motDePasse" value="<?php echo isset($motDePasse) ? $motDePasse : ''; ?>" required><br>

    <!-- <label for="profil">Profil :</label>
    <select id="profil" name="profil"  value="<?php echo isset($profil) ? $profil : ''; ?>" required> 
      <option value="admin">Admin</option>
      <option value="secretaire">Secrétaire</option>
      <option value="chefProjet">Chef de projet</option>
      <option value="comptable">Comptable</option>
      <option value="directeur">Directeur</option>
    </select><br> -->

    <input type="submit" value="Enregistrer">
    <input type="reset" value="Annuler">
  </form>
</body>
</html>
