<?php include "menu.php" ?>
<script src="script1.js"></script>
<style>
    /* Styles for the form */
    form {
        display: flex;  
        /* justify-content: center; */
        gap: 10px;
        margin-bottom: 20px;
        width: 800px;
    }
    input[type="submit"]:hover {
        /* background-color: green; */
        cursor: pointer;  
    }
    input {
        height: 40px;
        width: 250px;
    }
    input[type="submit"] {
        width: 100px;
    }
</style>

<!-- Formulaire de recherche dans la corbeille -->
<!-- <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="searchCorbeille">Rechercher un utilisateur dans la corbeille :</label>
    <input type="text" id="searchCorbeille" name="searchCorbeille">
    <input type="submit" value="Rechercher">
</form> -->

<!-- Tableau des utilisateurs de la corbeille -->
<h1>Historiques Utilisateurs Ajoutes</h1>
<table>
    <tr>
        <th>Nom de l'utilisateur ajouté</th>
        <th>Profil de l'utilisateur</th>
        <th>Ajouté par :</th>
        <th>Date&heure de l'ajout</th>
  
    </tr>
    <?php
    // Requête SQL pour récupérer les utilisateurs de la corbeille avec les informations de suppression
    $sqlCorbeille = "SELECT * FROM ajouts";

    // Filtrer par nom d'utilisateur si une valeur est saisie dans le champ de recherche
    // if (isset($_POST['searchCorbeille']) && !empty($_POST['searchCorbeille'])) {
    //     $searchCorbeille = $_POST['searchCorbeille'];
    //     $sqlCorbeille .= " WHERE corbeille.nom LIKE '%$searchCorbeille%'";
    // }

    // Exécution de la requête SQL
    $resultCorbeille = $conn->query($sqlCorbeille);

    // Affichage des utilisateurs de la corbeille dans le tableau
    if ($resultCorbeille->rowCount() > 0) {
        while ($rowCorbeille = $resultCorbeille->fetch()) {
            echo "<tr>";
            echo "<td>".$rowCorbeille['Nom_ajoute']."</td>";
            echo "<td>".$rowCorbeille['profil']."</td>";
            echo "<td>".$rowCorbeille['ajoute_par']."</td>";
            echo "<td>".$rowCorbeille['date_heure']."</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Aucun info d'un utilisateur modifie.</td></tr>";
    }
    ?>
</table>
