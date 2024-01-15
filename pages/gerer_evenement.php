<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site_sae";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Fonction pour échapper les données saisies par l'utilisateur
function secureInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

// Ajouter un événement
if (isset($_POST['ajouterEvenement'])) {
    $titre = secureInput($_POST['titre']);
    $description = secureInput($_POST['description']);
    $dateEvenement = secureInput($_POST['dateEvenement']);
    $lieu = secureInput($_POST['lieu']);


    $sql = "INSERT INTO Evenements (Titre, Description, DateEvenement, Lieu, Approuve)
            VALUES ('$titre', '$description', '$dateEvenement', '$lieu', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "Événement ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'événement : " . $conn->error;
    }
}

//Modifier un événement
if (isset($_POST['modifierEvenement'])) {
    $idEvenement = secureInput($_POST['idEvenement']);
    $titre = secureInput($_POST['titre']);
    $description = secureInput($_POST['description']);
    $dateEvenement = secureInput($_POST['dateEvenement']);
    $lieu = secureInput($_POST['lieu']);

    $updateSql = "UPDATE Evenements SET";
    $updateFields = array();

    if (!empty($titre)) {
        $updateFields[] = "Titre = '$titre'";
    }

    if (!empty($description)) {
        $updateFields[] = "Description = '$description'";
    }

    if (!empty($dateEvenement)) {
        $updateFields[] = "DateEvenement = '$dateEvenement'";
    }

    if (!empty($lieu)) {
        $updateFields[] = "Lieu = '$lieu'";
    }

    $updateSql .= " " . implode(", ", $updateFields);
    $updateSql .= " WHERE IDEvenement = $idEvenement";

    if ($conn->query($updateSql) === TRUE) {
        echo "Événement modifié avec succès.";
    } else {
        echo "Erreur lors de la modification de l'événement : " . $conn->error;
    }
}

// Approuver un événement
if (isset($_POST['approuverEvenement'])) {
    $idEvenement = secureInput($_POST['idEvenementApprouver']);

    $approveSql = "UPDATE Evenements SET Approuve = 1 WHERE IDEvenement = $idEvenement";

    if ($conn->query($approveSql) === TRUE) {
        echo "Événement approuvé avec succès.";
    } else {
        echo "Erreur lors de l'approbation de l'événement : " . $conn->error;
    }
}

// Supprimer un événement
if (isset($_POST['supprimerEvenement'])) {
    $idEvenement = secureInput($_POST['idEvenementSupprimer']);

    $deleteSql = "DELETE FROM Evenements WHERE IDEvenement = $idEvenement";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Événement supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'événement : " . $conn->error;
    }
}

// Récupération de la liste des événements
$sqlEvents = "SELECT * FROM Evenements";
$resultEvents = $conn->query($sqlEvents);

$sqlNonApprouves = "SELECT * FROM Evenements WHERE Approuve = 0";
$resultNonApprouves = $conn->query($sqlNonApprouves);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/gerer-evenement.css">
    <title>Gérer les Événements</title>
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


    <h1>Gérer les Événements</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h2>Ajouter un Événement</h2>
        <label for="titre">Titre :</label>
        <input class= "box"  type="text" name="titre" required>

        <label for="description">Description :</label>
        <textarea class= "box" name="description" required></textarea>

        <label for="dateEvenement">Date de l'événement :</label>
        <input class= "box"  type="date" name="dateEvenement" required>

        <label for="lieu">Lieu :</label>
        <input class= "box" type="text" name="lieu" required>

        <input class= "bouton" type="submit" name="ajouterEvenement" value="Ajouter Événement">
    </form>


    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h2>Modifier un Événement</h2>
        <label for="idEvenement">ID Événement :</label>
        <input class= "box"  type="text" name="idEvenement" required>

        <label for="titre">Titre :</label>
        <input class= "box"  type="text" name="titre">

        <label for="description">Description :</label>
        <textarea class= "box"  name="description"></textarea>

        <label for="dateEvenement">Date de l'événement :</label>
        <input class= "box"  type="date" name="dateEvenement">

        <label for="lieu">Lieu :</label>
        <input class= "box"  type="text" name="lieu">

        <input class= "bouton" type="submit" name="modifierEvenement" value="Modifier Événement">
    </form>

    <h2>Événements Non Approuvés</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Date de l'événement</th>
            <th>Lieu</th>
            <th>Approuvé</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $resultNonApprouves->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['IDEvenement']}</td>
                    <td>{$row['Titre']}</td>
                    <td>{$row['Description']}</td>
                    <td>{$row['DateEvenement']}</td>
                    <td>{$row['Lieu']}</td>
                    <td>{$row['Approuve']}</td>
                    <td>
                    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                        <input type='hidden' name='idEvenementApprouver' value='{$row['IDEvenement']}'>
                        <input type='submit' name='approuverEvenement' value='Approuver'>
                    </form>
                </td>
                </tr>";
        }
        ?>
    </table>

    <h2>Liste des Événements</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Date de l'événement</th>
            <th>Lieu</th>
            <th>Approuvé</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $resultEvents->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['IDEvenement']}</td>
                    <td>{$row['Titre']}</td>
                    <td>{$row['Description']}</td>
                    <td>{$row['DateEvenement']}</td>
                    <td>{$row['Lieu']}</td>
                    <td>{$row['Approuve']}</td>
                    <td>
                    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                    <input type='hidden' name='idEvenementApprouver' value='{$row['IDEvenement']}'>
                    <input type='submit' name='approuverEvenement' value='Approuver'>
                </form>
                <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                    <input type='hidden' name='idEvenementSupprimer' value='{$row['IDEvenement']}'>
                    <input type='submit' name='supprimerEvenement' value='Supprimer'>
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
$conn->close();
?>
