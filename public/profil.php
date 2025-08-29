<?php 
session_start();

require_once("../config/settings.php"); 


// Vérifier si user connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Récupérer les infos user depuis DB
$stmt = $pdo->prepare("SELECT full_name, email, phone, dob, created_at FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Formatage date francophone
function formatDateFr($date) {
    return date('d/m/Y', strtotime($date));
}

// Si formulaire soumis (modification profil)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $dob = $_POST['dob'];

    $updateStmt = $pdo->prepare("UPDATE users SET phone = ?, dob = ? WHERE id = ?");
    $updateStmt->execute([$phone, $dob, $_SESSION['user_id']]);

    header("Location: profile.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="AB Créations - Accueil" />
    <title>Espace membre - AB créations</title>
    <link rel="shortcut icon" href="../images/logoabcreation.png" />
    <link rel="stylesheet" href="../dist/css/theme.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
<div class="img-fond"></div>
<?php include('templates/header.php'); ?>

<main class="profile-container">
    <div class="profile-card">
        <div class="profile-left">
            <div class="avatar">
                <img src="assets/images/account_circle.png" alt="Avatar Utilisateur" />
            </div>
            <h1 class="name"><?= htmlspecialchars($user['full_name']) ?></h1>
            <p>Date de naissance : <?= $user['dob'] ? formatDateFr($user['dob']) : 'Non renseignée' ?></p>
            <p>Inscrit depuis le : <?= formatDateFr($user['created_at']) ?></p>
        </div>

<div class="profile-right">
    <?php if (isset($_GET['success'])): ?>
        <p class="success-message">Profil mis à jour avec succès !</p>
    <?php endif; ?>

        <!-- Bloc affichage info simple (au départ visible) -->
        <div class="profile-info">
            <p>Email : <?= htmlspecialchars($user['email']) ?></p>
            <p>Numéro de téléphone : <?= htmlspecialchars($user['phone'] ?? 'Non renseigné') ?></p>
            <p>Date de naissance : <?= $user['dob'] ? formatDateFr($user['dob']) : 'Non renseignée' ?></p>
            <button id="btnShowForm" class="edit-profile">Modifier mon profil</button>
        </div>

        <!-- Formulaire de modification (caché au départ) -->
        <form method="POST" class="profile-form" id="profileForm" action="profil.php">
            <label>Email :</label>
            <input type="email" value="<?= htmlspecialchars($user['email']) ?>" readonly />

            <label for="phone">Numéro de téléphone :</label>
            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" />

            <label for="dob">Date de naissance :</label>
            <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($user['dob'] ?? '') ?>" />

            <button type="submit" name="update_profile">Enregistrer</button>
            <button type="button" id="btnCancel" style="margin-left:10px;">Annuler</button>
        </form>

            <form method="POST" action="auth/change_password.php" style="margin-top: 1rem;">
                <h3>Modifier mot de passe</h3>
                <label for="old_password">Ancien mot de passe :</label>
                <input type="password" id="old_password" name="old_password" required />

                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" id="new_password" name="new_password" required />

                <label for="confirm_password">Confirmer nouveau mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" required />

                <button type="submit" name="change_password">Changer le mot de passe</button>
            </form>

            <form method="POST" action="auth/logout.php" style="margin-top: 1rem;">
                <button type="submit" class="logout">Se déconnecter</button>
            </form>

            <form method="POST" action="auth/delete_account.php" style="margin-top: 1rem;" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ? Cette action est irréversible.')">
                <button type="submit" class="delete-profile">Supprimer son profil</button>
            </form>
        </div>
    </div>
</main>

<?php include('templates/footer.php'); ?>
<div class="layer"></div>
<script async src="../dist/js/theme.js"></script>
<script src="assets/scripts/components/profil.js"></script>
</body>

</html>