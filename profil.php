<?php 

require_once("config/settings.php"); 

?>
<!DOCTYPE html>
<html lang="en">

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

<body>
        <div class="img-fond"></div>
        <?php include ('templates/header.php'); ?>
    <main class="profile-container">
        <div class="profile-card">
            <div class="profile-left">
                <div class="avatar">
                    <img src="assets/images/account_circle.png" alt="Avatar Utilisateur" />
                </div>
                <h1 class="name">Nom/Prénom</h1>
                <p>Date de naissance : xx/xx/xxxx</p>
                <p>Inscrit depuis le : xx/xx/xxxx</p>

                <button class="edit-profile">Modifier son profil</button>
            </div>
            <div class="profile-right">
                <form class="profile-form">
                    <label>Email :</label>
                    <input type="email" value="exemple@gmail.com" readonly />

                    <label>Numéro de téléphone :</label>
                    <input type="tel" value="XX-XX-XX-XX-XX" readonly />

                    <label>Mot de passe :</label>
                    <input type="password" value="*******************" readonly />
                </form>

                <button class="logout">Se déconnecter</button>
                <button class="delete-profile">Supprimer son profil</button>
            </div>
        </div>

    </main>

    <?php include ('templates/footer.php'); ?>


    <div class="layer"></div>
    <script async src="dist/js/theme.js"></script>
</body>

</html>