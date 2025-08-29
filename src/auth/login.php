<?php
session_start();
require_once("../config/settings.php");

// Limiter nombre de tentatives
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if ($_SESSION['login_attempts'] >= 5) {
    die("Trop de tentatives. Merci de réessayer plus tard.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nettoyage & validation minimal côté serveur
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (!$email || empty($password)) {
        die("Email ou mot de passe invalide.");
    }

    try {
        // Requête préparée sécurisée
        $stmt = $pdo->prepare("SELECT id, email, full_name, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Mot de passe ok => connexion

            // Réinitialiser tentative
            $_SESSION['login_attempts'] = 0;

            // Regénérer ID session pour éviter fixation de session
            session_regenerate_id(true);

            // Stocker infos utiles en session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['full_name'];

            // Gestion "se souvenir de moi"
            if ($remember) {
                // Token simple (à améliorer pour prod avec base + expiration)
                $token = bin2hex(random_bytes(32));
                setcookie("remember_token", $token, [
                    'expires' => time() + 60*60*24*30, // 30 jours
                    'path' => '/',
                    'secure' => true,    // que HTTPS
                    'httponly' => true,  // pas accessible JS
                    'samesite' => 'Lax'
                ]);
            }

            // Redirection vers espace membre
            header("Location: ../profil.php");
            exit();
        } else {
            // Mauvais identifiants
            $_SESSION['login_attempts']++;
            echo "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        // Ne pas afficher d’erreur brute en prod !
        error_log("Erreur SQL login : " . $e->getMessage());
        echo "Erreur serveur, veuillez réessayer plus tard.";
    }
} else {
    // Accès direct interdit
    http_response_code(405);
    echo "Méthode non autorisée.";
}
?>
