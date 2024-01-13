<?php
// Inclusion de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../phpmailer/PHPMailer6/src/Exception.php';
require '../phpmailer/PHPMailer6/src/PHPMailer.php';
require '../phpmailer/PHPMailer6/src/SMTP.php';



$hote = "localhost"; 
$bd = "site_sae"; 
$login = "root"; 
$mdp = ""; 

try {
    $bdd = new PDO("mysql:host=$hote;dbname=$bd", $login, $mdp);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    

    if (empty($nom) || empty($prenom) || empty($email)) {
        die('Veuillez remplir tous les champs.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Adresse email invalide.');
    }

    
    // Génération d'un mot de passe aléatoire
    $password = bin2hex(random_bytes(4)); // Génère un mot de passe de 8 caractères
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    

    $sql = "INSERT INTO Utilisateur (Nom, Prenom, Email, MotDePasse) VALUES (?, ?, ?, ?)";
    $stmt = $bdd->prepare($sql);

    try {
        $stmt->execute([$nom, $prenom, $email, $hashed_password]);
        $lastId = $bdd->lastInsertId(); // Récupérer l'ID de l'utilisateur inscrit
        $identifiant = $nom . $prenom . $lastId;

        // Initialisation de PHPMailer
        $mail = new PHPMailer(true);
    
        try {
            // Paramètres du serveur
            $mail->isSMTP();
            $mail->Host       = 'smtp.outlook.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'furkanmutluiut@outlook.com'; 
            $mail->Password   = 'Iutamiens'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
    
            // Destinataires
            $mail->setFrom('furkanmutluiut@outlook.com', 'Site CID');
            $mail->addAddress($email, $nom); 
    
            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'Votre inscription sur notre site';
            $mail->Body    = 'Bonjour ' . $prenom . ',<br>Votre identifiant est : ' . $identifiant . '<br>Votre mot de passe est : ' . $password;
            $mail->AltBody = 'Bonjour ' . $prenom . ', Votre identifiant est : ' . $identifiant . ' Votre mot de passe est : ' . $password;
    
            $mail->send();
            header('Refresh: 5; url=page connexion.html');
            echo 'Un email avec vos informations vous a été envoyé. Vous allez être redirigé vers la page de connexion.';
        } catch (Exception $e) {
            echo "L'email avec vos informations n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
        }
    } catch(PDOException $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }

                $stmt = null;
                }

                $bdd = null;
?>


