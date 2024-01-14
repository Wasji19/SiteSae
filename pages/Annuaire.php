<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site_sae";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer la valeur de recherche
$recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';

// Récupérer le critère de tri et l'ordre
$tri = isset($_GET['tri']) ? $_GET['tri'] : 'Nom';
$ordre = isset($_GET['ordre']) ? $_GET['ordre'] : 'ASC';

// Tri
$sql = "SELECT * FROM Utilisateur WHERE Nom LIKE '%$recherche%' OR Prenom LIKE '%$recherche%' ORDER BY $tri $ordre";

// Exécuter la requête SQL
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire des Utilisateurs</title>
    <style>
        .card {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        select {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Annuaire des Utilisateurs</h1>

<form method="POST" action="annuaire.php">
    <label for="recherche">Recherche :</label>
    <input type="text" name="recherche" id="recherche" value="<?php echo $recherche; ?>">
    <input type="submit" value="Rechercher">
</form>

<form method="GET" action="annuaire.php">
    <label for="tri">Trier par :</label>
    <select name="tri" id="tri">
        <option value="Nom" <?php echo ($tri == 'Nom') ? 'selected' : ''; ?>>Nom</option>
        <option value="Prenom" <?php echo ($tri == 'Prenom') ? 'selected' : ''; ?>>Prénom</option>
        <option value="DateNaissance" <?php echo ($tri == 'DateNaissance') ? 'selected' : ''; ?>>Date de Naissance</option>
        <option value="IDPromotion" <?php echo ($tri == 'IDPromotion') ? 'selected' : ''; ?>>Promotion</option>
    </select>

    <label for="ordre">Ordre :</label>
    <select name="ordre" id="ordre">
        <option value="ASC" <?php echo ($ordre == 'ASC') ? 'selected' : ''; ?>>Croissant</option>
        <option value="DESC" <?php echo ($ordre == 'DESC') ? 'selected' : ''; ?>>Décroissant</option>
    </select>

    <input type="submit" value="Appliquer le tri">
</form>

<!-- Afficher les résultats sous forme de cartes -->
<div style="display: flex; flex-wrap: wrap;">

    <?php
    // Afficher les résultats
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>
                    <h3>{$row['Prenom']} {$row['Nom']}</h3>
                    <p>Date de Naissance: {$row['DateNaissance']}</p>
                    <p>Promotion: {$row['IDPromotion']}</p>
                </div>";
        }
    } else {
        echo "<p>Aucun résultat trouvé.</p>";
    }
    ?>

</div>

</body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>
