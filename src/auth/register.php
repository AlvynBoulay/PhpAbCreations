<?php
require_once("../config/settings.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des champs
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $dob = $_POST['dob'];
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : null;
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Vérification du mot de passe
    if ($password !== $confirmPassword) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Hachage du mot de passe (bcrypt)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO users (email, full_name, dob, phone, password)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$email, $name, $dob, $phone, $hashedPassword]);
        header("Location: page-connexion.php");
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Un compte avec cet email existe déjà.";
        } else {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>
