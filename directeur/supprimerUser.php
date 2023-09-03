<?php
include "menu.php";
?>

<?php

// Vérifier si l'identifiant de l'utilisateur est passé en paramètre
if (isset($_GET['id'])) {
  // Récupérer l'identifiant de l'utilisateur
  $id = $_GET['id'];


  // Requête SQL pour supprimer l'utilisateur de la table "utilisateur"
  $sql = "DELETE FROM utilisateur WHERE id = $id";

  if ($conn->query($sql)) {
    header("Location: affichageUser.php");

  } 
} 
?>
