<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../phpmailer/PHPMailer6/src/Exception.php';
require '../phpmailer/PHPMailer6/src/PHPMailer.php';
require '../phpmailer/PHPMailer6/src/SMTP.php';

$hote = 'localhost';
$bd = 'site_sae';
$login = 'root';
$mdp = '';

try {
    $bdd = new PDO("mysql:host=$hote;dbname=$bd", $login, $mdp);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    if (empty($email)) {
        die('Veuillez saisir votre adresse email.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Adresse email invalide.');
    }

    // Génération d'un nouveau mot de passe
    $newPassword = bin2hex(random_bytes(4)); // Génère un mot de passe de 8 caractères
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

    // Mise à jour du mot de passe dans la base de données
    $sql = "UPDATE Utilisateur SET MotDePasse = ? WHERE Email = ?";
    $stmt = $bdd->prepare($sql);

    try {
        $stmt->execute([$hashed_password, $email]);

        
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.outlook.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'furkanmutluiut@outlook.com'; 
            $mail->Password = 'Iutamiens'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('furkanmutluiut@outlook.com', 'Site CID');
            $mail->addAddress($email); // Ajouter l'adresse email de l'utilisateur

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Réinitialisation du mot de passe';
        $mail->Body    = 'Bonjour, <br>Votre mot de passe a été réinitialisé. Voici votre nouveau mot de passe : ' . $newPassword;
        $mail->AltBody = 'Bonjour, Votre mot de passe a été réinitialisé. Voici votre nouveau mot de passe : ' . $newPassword;

        
            $mail->send();
            header('Refresh: 5; url=page connexion.html');
            echo 'Un email avec votre nouveau mot de passe a été envoyé. Vous allez être redirigé vers la page de connexion.';
        } catch (Exception $e) {
            echo "L'email n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
        }
    } catch(PDOException $e) {
        die("Erreur lors de la réinitialisation : " . $e->getMessage());
    }
    
    $stmt = null;
    
}

$bdd = null;
?>
