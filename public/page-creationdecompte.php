<?php 

require_once("../config/settings.php"); 

?>
<!DOCTYPE html>
<html lang="fr">

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
        <?php include ('templates/header.php'); ?>
        <main class="form-container">
            <form class="signup-form" action="auth/register.php" method="POST">
                <h1>Création d’un compte</h1>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required />

                <label for="name">Nom complet :</label>
                <input type="text" id="name" name="name" required />

                <label for="dob">Date de naissance :</label>
                <input type="date" id="dob" name="dob" required />

                <label for="phone">Numéro de tél. (facultatif) :</label>
                <input type="tel" id="phone" name="phone" />

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required />

                <label for="confirm-password">Confirmer le mot de passe :</label>
                <input type="password" id="confirm-password" name="confirm-password" required />

                <div class="checkbox-container">
                    <input type="checkbox" id="terms" required />
                    <label for="terms">
                        En soumettant ce formulaire, vous acceptez nos
                        <a href="#">mentions légales</a> &
                        <a href="#">Conditions Générales d’Utilisation</a>
                    </label>
                </div>

                <button type="submit" class="submit-button">S'inscrire</button>

                <p class="already-account">Vous avez déjà un compte ? <a href="page-connexion.php">Connectez-vous !</a>
                </p>
            </form>
        </main>
        <?php include ('templates/footer.php'); ?>
    <div class="layer"></div>
    <script async src="../dist/js/theme.js"></script>
    <script src="assets/scripts/btnRetourEnHaut.js"></script>
</body>

</html>