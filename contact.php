<?php 

require_once("config/settings.php");

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=abcreations;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $nom = $_POST['nomcomplet'];
    $email = $_POST['email'];
    $telephone = !empty($_POST['telephone']) ? $_POST['telephone'] : null;
    $message = $_POST['message'];

    try {
        // Insertion dans la base
        $stmt = $pdo->prepare(
            "INSERT INTO MessageContact (nom_complet, email, telephone, message)
             VALUES (:nom, :email, :telephone, :message)"
        );
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':message' => $message
        ]);

        // Envoi à Formspree
        $formspreeUrl = "https://formspree.io/f/xpwlpqrz";
        $postData = [
            'nomcomplet' => $nom,
            'email' => $email,
            'telephone' => $telephone,
            'message' => $message
        ];

        $ch = curl_init($formspreeUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Redirection après succès
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
        exit();

    } catch (PDOException $e) {
        echo "<div style='color: red;'>Erreur : " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="AB Créations - Accueil" />
    <title>Contact - AB créations</title>
    <link rel="shortcut icon" href="images/logoabcreation.png" />
    <link rel="stylesheet" href="dist/css/theme.css" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <div class="img-fond"></div>
    <?php include('templates/header.php'); ?>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div id="success-toast" class="toast">✅ Message envoyé avec succès !</div>
    <?php endif; ?>

    <main class="contact-container">
        <div class="contact-box">
            <h1>Formulaire de contact</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="nomcomplet">Nom Complet :</label>
                <input type="text" name="nomcomplet" id="nomcomplet" required />

                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required />

                <label for="telephone">Numéro de téléphone (facultatif) :</label>
                <input type="text" name="telephone" id="telephone" />

                <label for="message">Message :</label>
                <textarea name="message" id="message" rows="5"></textarea>

                <input type="hidden" value="50" name="id-article" />

                <div class="contact-rgpd">
                    <input type="checkbox" id="rgpd" required />
                    <label for="rgpd">
                        J'autorise le traitement de mes données pour recevoir des offres commerciales et des
                        promotions.
                    </label>
                </div>

                <button type="submit" name="submit" class="contact-button">Envoyer</button>
            </form>
        </div>
    </main>

    <section>
        <div class="contact-via">
            <h2>Ou contacter moi via :</h2>
            <div class="btnicon">
                <a href="https://www.instagram.com/alv.bou?igsh=aXk1enJqcXM3ZHhs&utm_source=qr">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://discord.gg/j2kG4fFrNX">
                    <i class="fab fa-discord"></i>
                </a>
                <a href="https://x.com/z3s_2?s=21">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <section class="footer-inner">
            <div class="btnreturn">
                <a href="x">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </section>
    </footer>

    <div class="layer"></div>

    <script src="assets/scripts/components/toast.js"></script>  
    <script async src="dist/js/theme.js"></script>
</body>

</html>
