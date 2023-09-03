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
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="searchCorbeille">Rechercher un utilisateur dans la corbeille :</label>
    <input type="text" id="searchCorbeille" name="searchCorbeille">
    <input type="submit" value="Rechercher">
</form>

<!-- Tableau des utilisateurs de la corbeille -->
<table>
    <tr>
        <th>Matricule</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Login</th>
        <th>Profil</th>
        <th>Supprimer par</th>
        <th>Date&Heure</th>
        <th>Action</th>
    </tr>
    <?php
    // Requête SQL pour récupérer les utilisateurs de la corbeille avec les informations de suppression
    $sqlCorbeille = "SELECT * FROM corbeille";

    // Filtrer par nom d'utilisateur si une valeur est saisie dans le champ de recherche
    if (isset($_POST['searchCorbeille']) && !empty($_POST['searchCorbeille'])) {
        $searchCorbeille = $_POST['searchCorbeille'];
        $sqlCorbeille .= " WHERE corbeille.nom LIKE '%$searchCorbeille%'";
    }

    // Exécution de la requête SQL
    $resultCorbeille = $conn->query($sqlCorbeille);

    // Affichage des utilisateurs de la corbeille dans le tableau
    if ($resultCorbeille->rowCount() > 0) {
        while ($rowCorbeille = $resultCorbeille->fetch()) {
            echo "<tr>";
            echo "<td>".$rowCorbeille['matriculeco']."</td>";
            echo "<td>".$rowCorbeille['nom']."</td>";
            echo "<td>".$rowCorbeille['Prenom']."</td>";
            echo "<td>".$rowCorbeille['login']."</td>";
            echo "<td>".$rowCorbeille['profil']."</td>";
            echo "<td>".$rowCorbeille['supprime_par']."</td>";
            echo "<td>".$rowCorbeille['date_heure_suppression']."</td>";
            echo "<td><a href='#' onclick='confirmRestore(\"".$rowCorbeille['matriculeco']."\")'>Restaurer</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Aucun utilisateur trouvé dans la corbeille.</td></tr>";
    }
    ?>
</table>
