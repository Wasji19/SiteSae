<?php
// Connexion à la base de données (remplacez ces valeurs par les vôtres)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site_sae";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Fonction pour échapper les données saisies par l'utilisateur
function secureInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

/// Ajout d'un utilisateur
if (isset($_POST['ajouterUtilisateur'])) {
    $nom = secureInput($_POST['nom']);
    $prenom = secureInput($_POST['prenom']);
    $email = secureInput($_POST['email']);
    $motDePasse = secureInput($_POST['motDePasse']);
    $dateNaissance = secureInput($_POST['dateNaissance']);
    $estAncienEtudiant = isset($_POST['estAncienEtudiant']) ? 1 : 0;
    $idPromotion = secureInput($_POST['idPromotion']);
    $idRole = secureInput($_POST['idRole']);
    $motDePasseHash = password_hash($motDePasse, PASSWORD_BCRYPT);


    $sql = "INSERT INTO Utilisateur (Nom, Prenom, Email, MotDePasse, DateNaissance, EstAncienEtudiant, IDPromotion, IDRole)
            VALUES ('$nom', '$prenom', '$email', '$motDePasseHash', '$dateNaissance', $estAncienEtudiant, $idPromotion, $idRole)";

    if ($conn->query($sql) === TRUE) {
        echo "Utilisateur ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $conn->error;
    }
}

// Modification d'un utilisateur
if (isset($_POST['modifierUtilisateur'])) {
    $idUtilisateur = secureInput($_POST['idUtilisateur']);
    $nom = secureInput($_POST['nom']);
    $prenom = secureInput($_POST['prenom']);
    $email = secureInput($_POST['email']);
    $motDePasse = secureInput($_POST['motDePasse']);
    $dateNaissance = secureInput($_POST['dateNaissance']);
    $estAncienEtudiant = isset($_POST['estAncienEtudiant']) ? 1 : 0;
    $idPromotion = secureInput($_POST['idPromotion']);
    $idRole = secureInput($_POST['idRole']);

    $updateAttributes = array();

    if (!empty($nom)) {
        $updateAttributes[] = "Nom = '$nom'";
    }
    if (!empty($prenom)) {
        $updateAttributes[] = "Prenom = '$prenom'";
    }
    if (!empty($email)) {
        $updateAttributes[] = "Email = '$email'";
    }
    if (!empty($motDePasse)) {
        $motDePasseHash = password_hash($motDePasse, PASSWORD_BCRYPT);
        $updateAttributes[] = "MotDePasse = '$motDePasseHash'";
    }
    if (!empty($dateNaissance)) {
        $updateAttributes[] = "DateNaissance = '$dateNaissance'";
    }
    $updateAttributes[] = "EstAncienEtudiant = $estAncienEtudiant";

    if (!empty($idPromotion)) {
        $updateAttributes[] = "IDPromotion = $idPromotion";
    }
    if (!empty($idRole)) {
        $updateAttributes[] = "IDRole = $idRole";
    }

    $sql = "UPDATE Utilisateur SET
                    Nom = '$nom',
                    Prenom = '$prenom',
                    Email = '$email',
                    MotDePasse = '$motDePasse',
                    DateNaissance = '$dateNaissance',
                    EstAncienEtudiant = $estAncienEtudiant,
                    IDPromotion = $idPromotion,
                    IDRole = $idRole
                    WHERE IDUtilisateur = $idUtilisateur";

    if (!empty($updateAttributes)) {
        $updateAttributesString = implode(", ", $updateAttributes);
        $sql = "UPDATE Utilisateur SET $updateAttributesString WHERE IDUtilisateur = $idUtilisateur";

        if ($conn->query($sql) === TRUE) {
            echo "Utilisateur modifié avec succès.";
        } else {
            echo "Erreur lors de la modification de l'utilisateur : " . $conn->error;
        }
    } else {
        echo "Aucun champ à mettre à jour.";
    }
}


// Suppression des doublons d'utilisateurs
if (isset($_POST['supprimerDoublons'])) {
    $sql = "DELETE u1 FROM Utilisateur u1
            INNER JOIN Utilisateur u2
            WHERE u1.IDUtilisateur < u2.IDUtilisateur
            AND u1.Nom = u2.Nom
            AND u1.Prenom = u2.Prenom
            AND u1.DateNaissance = u2.DateNaissance
            AND u1.IDPromotion = u2.IDPromotion";

    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            $messageDoublons = "Doublons supprimés avec succès.";
        } else {
            $messageDoublons = "Aucun doublon trouvé.";
        }
    } else {
        $messageDoublons = "Erreur lors de la suppression des doublons : " . $conn->error;
    }
}

if (isset($_POST['supprimerUtilisateur'])) {
    $idUtilisateurASupprimer = secureInput($_POST['idUtilisateurSupprimer']);
    $sqlSuppression = "DELETE FROM Utilisateur WHERE IDUtilisateur = $idUtilisateurASupprimer";

    if ($conn->query($sqlSuppression) === TRUE) {
        echo "Utilisateur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . $conn->error;
    }
}

$sqlUtilisateurs = "SELECT * FROM Utilisateur";
$resultUtilisateurs = $conn->query($sqlUtilisateurs);
$sqlRoles = "SELECT * FROM Role";
$resultRoles = $conn->query($sqlRoles);
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/gerer_utilisateur.css">
    <title>Gérer les Utilisateurs</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Remplacez le texte par votre logo -->
            <a class="navbar-brand" href="#">
                <img src="../assets/imgs/logoCID.png" alt="Logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="../pages/index_connect.php">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/admin.html">Panel Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Déconnexion</a>
                    </li>
                </ul>
                <form class="form-inline ml-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Recherche">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>

<h1>Gérer les Utilisateurs</h1>

<!-- Formulaire pour ajouter un utilisateur -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Ajouter un Utilisateur</h2>
    <label for="nom">Nom :</label>
    <input class= "box" type="text" name="nom" required>

    <label for="prenom">Prénom :</label>
    <input class= "box" type="text" name="prenom" required>

    <label for="email">Email :</label>
    <input class= "box" type="email" name="email" required>

    <label for="motDePasse">Mot de passe :</label>
    <input class= "box" type="password" name="motDePasse" required>

    <label for="dateNaissance">Date de naissance :</label>
    <input class= "box" type="date" name="dateNaissance" required>

    <label for="idPromotion">ID Promotion :</label>
    <input class= "box" type="text" name="idPromotion" required>

    <label for="estAncienEtudiant">Ancien étudiant :</label>
    <input class= "box" type="checkbox" name="estAncienEtudiant">

  

    <label for="role">Rôle :</label>
        <select name="role" required>
            <?php
            while ($rowRole = $resultRoles->fetch_assoc()) {
                echo "<option value='{$rowRole['IDRole']}'>{$rowRole['Role']}</option>";
            }
            ?>
        </select>
        <input class= "bouton" type="submit" name="ajouterUtilisateur" value="Ajouter Utilisateur">
</form>


<!-- Formulaire pour modifier un utilisateur -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Modifier un Utilisateur</h2>
    <label for="idUtilisateur">ID Utilisateur :</label>
    <input class= "box" type="text" name="idUtilisateur" required>

    <label for="nom">Nom :</label>
    <input class= "box" type="text" name="nom">

    <label for="prenom">Prénom :</label>
    <input class= "box" type="text" name="prenom">

    <label for="email">Email :</label>
    <input class= "box" type="email" name="email">

    <label for="motDePasse">Mot de passe :</label>
    <input class= "box"  type="password" name="motDePasse">

    <label for="dateNaissance">Date de naissance :</label>
    <input class= "box" type="date" name="dateNaissance">

    <label for="idPromotion">ID Promotion :</label>
    <input class= "box" type="text" name="idPromotion">

    <label for="estAncienEtudiant">Ancien étudiant :</label>
    <input class= "box"type="checkbox" name="estAncienEtudiant">

    <label for="role">Rôle :</label>
    <select name="role" required>
        <?php
        // Réinitialiser le pointeur du résultat pour la boucle suivante
        $resultRoles->data_seek(0);
        while ($rowRole = $resultRoles->fetch_assoc()) {
            $selected = ($rowRole['IDRole'] == $rowUtilisateur['IDRole']) ? 'selected' : '';
            echo "<option value='{$rowRole['IDRole']}' $selected>{$rowRole['Role']}</option>";
        }
        ?>
    </select>
    <input class= "bouton" type="submit" name="modifierUtilisateur" value="Modifier Utilisateur">
</form>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Supprimer les Doublons</h2>
    <input class= "bouton" type="submit" name="supprimerDoublons" value="Supprimer Doublons">
</form>



<h2>Liste des Utilisateurs</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Date de Naissance</th>
        <th>Est Ancien Étudiant</th>
        <th>ID Promotion</th>
        <th>ID Rôle</th>
        <th>Action</th>
    </tr>
    <?php
    while ($row = $resultUtilisateurs->fetch_assoc()) {
      echo "<tr>
              <td>{$row['IDUtilisateur']}</td>
              <td>{$row['Nom']}</td>
              <td>{$row['Prenom']}</td>
              <td>{$row['Email']}</td>
              <td>{$row['DateNaissance']}</td>
              <td>{$row['EstAncienEtudiant']}</td>
              <td>{$row['IDPromotion']}</td>
              <td>{$row['IDRole']}</td>
              <td>
                  <form method='post' action='{$_SERVER['PHP_SELF']}'>
                      <input  type='hidden' name='idUtilisateurSupprimer' value='{$row['IDUtilisateur']}'>
                      <input  type='submit' name='supprimerUtilisateur' value='Supprimer'>
                  </form>
              </td>
            </tr>";
    }
    ?>
</table>

<footer class=" pt-4 pb-0" style="background-color: #d9d9d9;"> 
        <div class ="container text-center text-md-left"> 
            <div class = " row text-center text-md-left"> 
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3"> 
                    <h5 class="text-uppercase mb-4 font-weight-bold ">Notre site</h5>
                        <p>
                            <a href="../pages/événements.html" class="" style="text-decoration : none;"> Les événements </a>
                        </p>
                        <p>
                            <a href="../pages/Calendrier.html" class="" style="text-decoration : none;"> Calendrier </a>
                        </p>
                        <p>
                            <a href="../pages/Annuaire.php" class="" style="text-decoration : none;"> Annuaires </a>
                        </p>
                        <p>
                            <a href="../pages/Galerie.html" class="" style="text-decoration : none;"> Galerie </a>
                        </p>
                    
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4  font-weight-bold">A propos</h5>
                        <p><a href="../pages/Contacter.html" class="" style="text-decoration : none;"> Nous joindre </a></p>
                        <p><a href="../pages/Inscription.html" class="" style="text-decoration : none;"> Inscription </a></p>
                        <p><a href="#" class="" style="text-decoration : none;"> L'association </a></p> 
                        <p><a href="../pages/page connexion.html" class="" style="text-decoration : none;"> Se connecter </a></p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-4">
                    <h5 class="text-uppercase mb-4 font-weight-bold ">Contact</h5>
                        <p>
                            <i class="fas fa-home mr-3 "></i>Avenue des Facultés, Le Bailly, 80025 Amiens
                        </p>
                        <p>
                            <i class="fas fa-phone mr-3 "></i>Tél. +33(0)3.22.53.40.40
                        </p>
                        <p>
                            <i class="fas fa-printer mr-3 "></i>Fax. +33(0)3.22.89.66.33
                        </p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>

<?php
if (isset($messageDoublons)) {
    echo "<p>$messageDoublons</p>";
}
// Fermer la connexion à la base de données
$conn->close();
?>
