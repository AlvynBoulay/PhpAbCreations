<?php 
require_once("../config/settings.php");

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=abcreations', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur DB : '.$e->getMessage());
}

// Traitement du formulaire newsletter
if (isset($_POST['newsletter'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $rgpd = isset($_POST['rgpd']) ? true : false;

    if ($email && $rgpd) {
        // Vérifier si l'email n'existe pas déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM newsletter_subscribers WHERE email = ?");
        $stmt->execute([$email]);
        $exists = $stmt->fetchColumn();

        if (!$exists) {
            // Insérer l'email dans la table
            $stmt = $pdo->prepare("INSERT INTO newsletter_subscribers (email, date_subscribed) VALUES (?, NOW())");
            $stmt->execute([$email]);
            $message = "Merci pour votre inscription à la newsletter !";
        } else {
            $message = "Cet email est déjà inscrit.";
        }
    } else {
        $message = "Veuillez entrer un email valide et accepter le RGPD.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="AB Créations - Accueil" />
    <title>Espace membre - AB créations</title>
    <link rel="shortcut icon" href="assets/images/logoabcreation.png" />
    <link rel="stylesheet" href="../dist/css/theme.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body data-page="a-propos">
    <div class="img-fond"></div>
    <?php include ('templates/header.php'); ?>
    <main>
        <div class="ap-title">
            <h1>À propos</h1>
        </div>
        <div class="ap-container">
            <div class="ap-subtitle">
                <h3>Mon Parcours Artistique :</h3>
            </div>

            <div class="ap-paragraph">
                <p>
                    Passionné par l’art depuis toujours, j’ai suivi un chemin atypique, façonné par la curiosité et
                    l’expérimentation.
                    Autodidacte, j’ai appris à explorer différentes techniques et médiums, en me nourrissant
                    d’inspirations
                    variées,
                    des grands maîtres classiques aux courants contemporains. Au fil des années, j’ai affiné mon style à
                    travers la pratique,
                    les essais et les erreurs, laissant mon instinct guider mon évolution. Internet, les livres et
                    qui m’entoure ont été mes meilleurs professeurs, me permettant de développer une approche libre et
                    personnelle de la création.
                </p>
            </div>
        </div>
        <div class="ab-bottom-wrapper">
            <section id="inscription-newsletter">
                <div class="newsletter-combined">
                    <h2>📩 Ne manque rien de mon univers !</h2>
                    <p>
                        <strong>Reçois mes dernières créations, les coulisses de mon travail et des exclusivités
                            directement
                            dans ta boîte mail.</strong>
                        <br>
                        ✅ Découvre mes nouvelles créations en avant-première<br>
                        ✅ Accède à du contenu inédit et des inspirations exclusives<br>
                        ✅ Profite de surprises et d’offres spéciales 🎁<br><br>
                        💡 Pas de spam, juste de l'inspiration !
                    </p>
                    <div class="newsletter-form">
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php if (isset($message)) : ?>
                                <p class="newsletter-message"><?= htmlspecialchars($message) ?></p>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="email">E-mail :</label>
                                <input type="email" name="email" id="email" class="input-large" required>
                            </div>

                            <div class="form-group">
                                <label for="rgpd">
                                    <input type="checkbox" id="rgpd" name="rgpd" required>
                                    J'autorise le traitement de mes données pour recevoir des offres commerciales et des
                                    promotions.
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="newsletter" class="btn-newsletter">S'abonner à la
                                    Newsletter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section class="ab-discord-container">
                <div class="ab-discord-content">
                    <h2 class="ab-discord-title">🎨 Rejoignez notre communauté sur Discord !</h2>
                    <p class="ab-discord-text">
                        AB Créations, ce n’est pas qu’un site web : c’est aussi un espace vivant d’échange, de partage
                        et
                        d’inspiration.
                    </p>
                    <p class="ab-discord-text">
                        Vous êtes artiste, passionné de création numérique, ou simplement curieux ? Notre serveur
                        Discord
                        est fait pour vous !
                    </p>
                    <ul class="ab-discord-list">
                        <li>🎨 Partagez vos œuvres et découvrez celles des autres artistes</li>
                        <br>
                        <li>💬 Discutez d’art numérique, posez vos questions, échangez des conseils</li>
                        <br>
                        <li>🛠️ Demandez des projets personnalisés ou proposez vos idées</li>
                        <br>
                        <li>🌟 Profitez d’une ambiance bienveillante, créative et motivante</li>
                    </ul>
                    <a href="https://discord.gg/j2kG4fFrNX" class="ab-discord-button" target="_blank">
                        🚀 Rejoindre le serveur Discord
                    </a>
                </div>
            </section>
        </div>
    </main>
    <?php include ('templates/footer.php'); ?>
    <div class="layer"></div>
    <script async src="../dist/js/theme.js"></script>
    <script src="assets/scripts/btnRetourEnHaut.js"></script>
</body>

</html>
