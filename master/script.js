// script.js

function confirmDelete(matricule) {
    if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
      window.location.href = 'affichageUser.php?code=' + matricule;
    }
  }
  