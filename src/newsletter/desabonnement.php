<?php

/**
 * Script de désabonnement à la newsletter.
 * Prend un paramètre GET 'email' pour supprimer cet email de la base.
 * Valide l'email, supprime l'entrée dans la table newsletter_subscribers.
 * Affiche un message selon le succès ou l'absence de l'email.
 */


// Paramètres de connexion à la base de données
$host = 'localhost';
$db   = 'abcreations';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Construction du DSN et options PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les exceptions en cas d'erreur
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

// Vérification que l'email est bien passé en paramètre GET
if (!isset($_GET['email'])) {
    die("Lien invalide : aucun email fourni.");
}

// Validation de l'email reçu
$email = filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);
if (!$email) {
    die("Email invalide.");
}

try {
    // Connexion à la base de données
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Suppression de l'email dans la table des abonnés
    $stmt = $pdo->prepare("DELETE FROM newsletter_subscribers WHERE email = ?");
    $stmt->execute([$email]);

    // Vérification si une ligne a été supprimée
    if ($stmt->rowCount() > 0) {
        echo "Vous êtes désabonné avec succès.";
    } else {
        echo "Cet email n'était pas inscrit dans notre newsletter.";
    }
} catch (Exception $e) {
    // En cas d'erreur de connexion ou requête SQL
    echo "Erreur : " . $e->getMessage();
}
?>
