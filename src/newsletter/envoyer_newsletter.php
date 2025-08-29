<?php

/**
 * Envoi la newsletter avec la dernière création à tous les abonnés.
 * Protégé par un token passé en GET (?token=xxx).
 * Utilise PHPMailer et Dotenv pour gérer l'envoi et la config.
 */

require '../../libs/PHPMailer-master/src/Exception.php';
require '../../libs/PHPMailer-master/src/PHPMailer.php';
require '../../libs/PHPMailer-master/src/SMTP.php';
require __DIR__ . '/../../vendor/autoload.php'; // chargement composer & dotenv

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Simple vérification token sécurité en GET (ex: ?token=xxx)
if (!isset($_GET['token']) || $_GET['token'] !== $_ENV['TOKEN_SECRET']) {
    http_response_code(403);
    die('Accès interdit : token invalide');
}

// Connexion DB via PDO avec variables d'env
$host = $_ENV['DB_HOST'];
$db = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$charset = $_ENV['DB_CHARSET'];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erreur connexion DB : " . $e->getMessage());
}

// Récupérer les emails abonnés
$stmt = $pdo->query("SELECT email FROM newsletter_subscribers");
$emails = $stmt->fetchAll(PDO::FETCH_COLUMN);

if (empty($emails)) {
    die("Aucun abonné trouvé.\n");
}

// Récupérer dernière création
$stmt = $pdo->query("SELECT title, description, cover FROM portfolio ORDER BY id DESC LIMIT 1");
$creation = $stmt->fetch();

if (!$creation) {
    die("Aucune création trouvée.\n");
}

$subject = "Nouvelle creation sur AB Creations !";

$imageDir = __DIR__ . '/../../public/assets/images/cover/';

foreach ($emails as $email) {
    $titre = htmlspecialchars($creation['title']);
    $desc = nl2br(htmlspecialchars($creation['description']));
    $cover = $creation['cover'];

    if (!preg_match('/\.(jpg|jpeg|png|gif)$/i', $cover)) {
        $cover .= '.jpg';
    }

    $imagePath = $imageDir . $cover;

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        $mail->setFrom($_ENV['SMTP_USER'], 'AB Creations');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;

        $mailContent = "<h2>🎨 Nouvelle création sur AB Créations !</h2>";
        $mailContent .= "<p>Bonjour, voici la dernière œuvre publiée :</p>";
        $mailContent .= "<strong>$titre</strong><br>$desc<br>";

        if (file_exists($imagePath)) {
            $mail->addEmbeddedImage($imagePath, 'coverimage');
            $mailContent .= "<img src=\"cid:coverimage\" alt=\"$titre\" style=\"max-width:300px; height:auto;\"><br>";
        } else {
            $mailContent .= "<p><i>Image indisponible</i></p>";
        }

        $mailContent .= "<p>Pour découvrir plus de créations, rendez-vous sur <a href='http://alvyn.local/'>notre site</a> !</p>";
        $mailContent .= "<hr>";
        $mailContent .= "<p>Si vous ne souhaitez plus recevoir ces emails, cliquez ici pour vous <a href='http://alvyn.local/newsletter/desabonnement.php?email=" . urlencode($email) . "'>désabonner</a>.</p>";

        $mail->Body = $mailContent;

        $mail->send();
        echo "Newsletter envoyée à $email<br>";
    } catch (Exception $e) {
        echo "Erreur pour $email : {$mail->ErrorInfo}<br>";
    }
}

echo "Envoi terminé à " . count($emails) . " abonnés.<br>";
