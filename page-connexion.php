<?php 

require_once("config/settings.php"); 

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="AB Créations - Accueil" />
    <title>Espace membre - AB créations</title>
    <link rel="shortcut icon" href="images/logoabcreation.png" />
    <link rel="stylesheet" href="dist/css/theme.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body data-page="accueil">
        <div class="img-fond"></div>
            <?php include ('templates/header.php'); ?>
        <main class="login-container">
            <div class="login-box">
                <h1>Connexion à votre compte</h1>
                <form>
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>

                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>

                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>

                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="login-button">Se connecter</button>
                </form>

                <p class="no-account">Vous n’avez pas de compte ? <a href="page-creationdecompte.php"
                        class="create-link">Créez-en un !</a></p>
            </div>
        </main>
        <?php include ('templates/footer.php'); ?>
    <div class="layer"></div>
    <script async src="dist/js/theme.js"></script>
</body>

</html>