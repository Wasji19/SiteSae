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
    <title>Gérer les Événements</title>
</head>
<body>

<h1>Gérer les Événements</h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Ajouter un Événement</h2>
    <label for="titre">Titre :</label>
    <input type="text" name="titre" required>

    <label for="description">Description :</label>
    <textarea name="description" required></textarea>

    <label for="dateEvenement">Date de l'événement :</label>
    <input type="date" name="dateEvenement" required>

    <label for="lieu">Lieu :</label>
    <input type="text" name="lieu" required>

    <input type="submit" name="ajouterEvenement" value="Ajouter Événement">
</form>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Modifier un Événement</h2>
    <label for="idEvenement">ID Événement :</label>
    <input type="text" name="idEvenement" required>

    <label for="titre">Titre :</label>
    <input type="text" name="titre">

    <label for="description">Description :</label>
    <textarea name="description"></textarea>

    <label for="dateEvenement">Date de l'événement :</label>
    <input type="date" name="dateEvenement">

    <label for="lieu">Lieu :</label>
    <input type="text" name="lieu">

    <input type="submit" name="modifierEvenement" value="Modifier Événement">
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

</body>
</html>

<?php
$conn->close();
?>
