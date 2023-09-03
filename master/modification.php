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
<table>
    <tr>
        <th>Modification des infos de :	</th>
        <th>Modifie par	</th>
        <th>Date&heure de la modification	</th>
  
    </tr>
    <?php
    // Requête SQL pour récupérer les utilisateurs de la corbeille avec les informations de suppression
    $sqlCorbeille = "SELECT * FROM modification";

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
            echo "<td>".$rowCorbeille['Modification_des_infos_de']."</td>";
            echo "<td>".$rowCorbeille['Modifie_par']."</td>";
            echo "<td>".$rowCorbeille['Date_heure_de_la_modification']."</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Aucun info d'un utilisateur modifie.</td></tr>";
    }
    ?>
</table>
