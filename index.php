<?php
session_start();
$adressServeur = "localhost";
$nomUtilisateur = "root";
$motDePasse = "";
$nomBD = "bad";
$connexion = new PDO("mysql:host=$adressServeur;dbname=$nomBD", $nomUtilisateur, $motDePasse);
?>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
            color:#009959;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #333333;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group .error-message {
            color: #009959;
            font-size: 14px;
            text-align: center;
            margin: 10px auto;
        }

        .form-group .button-container {
            text-align: center;
            margin-top: 20px;
            justify-content:center;
            display: flex;
        }

        .form {
            padding: 10px 20px;
            /* background-color: #4caf50; */
            color: #ffffff;
            border: none;
            display :flex;
            justify-content:center;
            gap:50px;
            border-radius: 4px;
        }
        input[type="reset"],  input[type="submit"] {
margin-top: 10px;
border-radius: 10px;
width: 150px;
background-color: #009959;
color: white;
padding: 10px 15px;
border: none;
margin-bottom: 10px;

}
input[type="submit"]:hover {
/* background-color: green; */
cursor: pointer;  
}
input[type="reset"]:hover {
/* background-color: green; */
cursor: pointer;  
background-color: #009959;

}

.error-message{
    color : red;
    font-weight: bold;
    text-align: center;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Veuillez vous Identifier</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="nom">Nom d'utilisateur</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="psw">Mot de passe</label>
                <input type="password" id="psw" name="psw" required>
            </div>

            <div class="form">
                <input type="submit" name="valider" value="Se connecter">
                <input type="reset" value="Annuler" >
            </div>
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
        $_SESSION['nom_utilisateur'] = $nom_utilisateur;
        if ($chefProjet == 'chefProjet') {
            // Créer la session pour le chef de projet
            $_SESSION['matricule_chefprojet'] = $row_chef['matricule_chefprojet']; // Enregistrez le login de l'utilisateur dans la session
            header('Location: chefprojet/accueil.php'); // Redirigez vers la page affichageProjet.php
            exit;
        } else {
            echo "<div class='error-message'>PARAMETRES INCORRECTS</div>";
        }
    } else {
        // Vérifier dans la table "utilisateur" pour les autres profils
        $requete_utilisateur = "SELECT * FROM utilisateurs WHERE login='$nom_utilisateur' AND motDePass='$mot_de_passe'";
        $res_utilisateur = $connexion->query($requete_utilisateur) or die(mysql_error());

        if ($res_utilisateur->rowCount() == 1) {
            $row_utilisateur = $res_utilisateur->fetch();
            $profil = $row_utilisateur['profil'];
            $_SESSION['nom_utilisateur'] = $nom_utilisateur;
            if ($profil == 'admin') {
                header('Location: master/accueil.php');
                exit;
            } elseif ($profil == 'directeur') {
                header('Location: directeur/accueil.php');
                exit;
            } elseif ($profil == 'comptable') {
                header('Location: comptable/accueil.php');
                exit;
            } elseif ($profil == 'secretaire') {
                header('Location: secretaire/accueil.php');
                exit;
            } else {
                echo "<div class='error-message'>PARAMETRES INCORRECTS</div>";
            }
        } else {
            echo "<div class='error-message'>PARAMETRES INCORRECTS</div>";
        }
    }
}
?>
