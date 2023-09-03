// script.js

function confirmRestore(matricule) {
    if (confirm("Voulez-vous vraiment restaurer cet utilisateur ?")) {
      window.location.href = "restaurerUtilisateur.php?code=" + matricule;
    }
  }
  