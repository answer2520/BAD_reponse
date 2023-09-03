<?php
session_start();
$adressServeur = "localhost";
$nomUtilisateur = "root";
$motDePasse = "";
$nomBD = "bad";
$connexion = new PDO("mysql:host=$adressServeur;dbname=$nomBD", $nomUtilisateur, $motDePasse);
?>

<form action="" method="post">
    <table>
        <tr>
            <td><label for="">Nom d'utilisateur</label></td>
            <td><input type="text" name="nom" /></td>
        </tr>

        <tr>
            <td><label for="">Mot de passe</label></td>
            <td><input type="password" name="psw" /></td>
        </tr>

        <tr>
            <td><input type="submit" name="valider" value="Se connecter"></td>
            <td><input type="reset" value="Annuler" /></td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST['valider'])) {
    $nom_utilisateur = $_POST['nom'];
    $mot_de_passe = $_POST['psw'];
    $requete_chef = "SELECT * FROM chefprojet WHERE login='$nom_utilisateur' AND motDePass='$mot_de_passe'";
    $res_chef = $connexion->query($requete_chef) or die(mysql_error());

    if ($res_chef->rowCount() == 1) {
        $row_chef = $res_chef->fetch();
        $chefProjet = $row_chef['profil'];

        if ($chefProjet == 'chefProjet') {
            // Créer la session pour le chef de projet
            $_SESSION['matricule_chefprojet'] = $row_chef['matricule_chefprojet']; // Enregistrez le login de l'utilisateur dans la session
            header('Location: affichageProjet.php'); // Redirigez vers la page affichageProjet.php
            exit;
        } else {
            echo "PARAMETRES INCORRECTS";
        }
    } else {
        // Vérifier dans la table "utilisateur" pour les autres profils
        $requete_utilisateur = "SELECT * FROM utilisateur WHERE login='$nom_utilisateur' AND motDePass='$mot_de_passe'";
        $res_utilisateur = $connexion->query($requete_utilisateur) or die(mysql_error());

        if ($res_utilisateur->rowCount() == 1) {
            $row_utilisateur = $res_utilisateur->fetch();
            $profil = $row_utilisateur['profil'];

            if ($profil == 'admin') {
                header('Location: afichadmin.php');
                exit;
            } elseif ($profil == 'directeur') {
                header('Location: afichdir.php');
                exit;
            } elseif ($profil == 'comptable') {
                header('Location: afichcompt.php');
                exit;
            } elseif ($profil == 'secretaire') {
                header('Location: afichsecr.php');
                exit;
            } else {
                echo "PARAMETRES INCORRECTS";
            }
        } else {
            echo "PARAMETRES INCORRECTS";
        }
    }
}
?>
