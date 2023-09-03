<?php include "menu.php" ?>

<?php
// restaurerUtilisateur.php

// Vérifier si l'identifiant de l'utilisateur est passé en paramètre
if (isset($_GET['code'])) {
  // Récupérer l'identifiant de l'utilisateur
  $id = $_GET['code'];

  // Requête SQL pour récupérer les informations de l'utilisateur dans la corbeille
  $sqlSelectCorbeille = "SELECT * FROM corbeille WHERE matriculeco = '$id'";
  $resultSelectCorbeille = $conn->query($sqlSelectCorbeille);

  // Vérifier si l'utilisateur existe dans la corbeille
  if ($resultSelectCorbeille->rowCount() == 1) {
    // Récupérer les informations de l'utilisateur dans la corbeille
    $rowCorbeille = $resultSelectCorbeille->fetch();
    $nom = $rowCorbeille['nom'];
    $prenom = $rowCorbeille['Prenom'];
    $telephone = $rowCorbeille['telephone'];
    $email = $rowCorbeille['email'];
    $login = $rowCorbeille['login'];
    $profil = $rowCorbeille['profil'];

    // Requête SQL pour restaurer l'utilisateur dans la table "utilisateurs"
    $sqlRestaurerus = "INSERT INTO utilisateurs (matricule, nom, Prenom, telephone, email, login, profil) VALUES ('$id', '$nom', '$prenom', '$telephone', '$email', '$login', '$profil')";
    $sqlRestaurerdir = "INSERT INTO directeur (matricule_dir, nom, Prenom, telephone, email, login, profil) VALUES ('$id', '$nom', '$prenom', '$telephone', '$email', '$login', '$profil')";
    $sqlRestaurerche = "INSERT INTO chefprojet (matricule_chefprojet, nom, Prenom, telephone, email, login, profil) VALUES ('$id', '$nom', '$prenom', '$telephone', '$email', '$login', '$profil')";
    $sqlRestaureradmin = "INSERT INTO administateur (matricule_adm, nom, Prenom, telephone, email, login, profil) VALUES ('$id', '$nom', '$prenom', '$telephone', '$email', '$login', '$profil')";
    $sqlRestaurercomp = "INSERT INTO comptable (matricule_compt, nom, Prenom, telephone, email, login, profil) VALUES ('$id', '$nom', '$prenom', '$telephone', '$email', '$login', '$profil')";
    $sqlRestaurersecr = "INSERT INTO secretaire (matricule_sec, nom, Prenom, telephone, email, login, profil) VALUES ('$id', '$nom', '$prenom', '$telephone', '$email', '$login', '$profil')";

    // Exécution de la requête SQL pour restaurer l'utilisateur
    if ($conn->query($sqlRestaurerus) && $conn->query($sqlRestaurerdir) && $conn->query($sqlRestaurerche) && $conn->query($sqlRestaureradmin) && $conn->query($sqlRestaurercomp) && $conn->query($sqlRestaurersecr)) {
      // Supprimer l'utilisateur de la corbeille
      $sqlDeleteCorbeille = "DELETE FROM corbeille WHERE matriculeco = '$id'";
      $conn->query($sqlDeleteCorbeille);

      header("Location: affichageUser.php");
    } else {
      echo "Erreur lors de la restauration de l'utilisateur : " . $conn->error;
    }
  } else {
    echo "Utilisateur non trouvé dans la corbeille.";
  }
}
?>
