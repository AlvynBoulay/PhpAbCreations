<?php 
require_once("../config/settings.php"); 

// récupère l'id passée en paramètre
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM portfolio WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

$portfolio = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=h, initial-scale=1.0" />
    <meta name="description" content="Détails Création - AB Créations" />
    <title><?php echo $portfolio['title']; ?> - AB Créations</title>
    <link rel="shortcut icon" href="<?php echo img_dir; ?>logoabcreation.png" />
    <link rel="stylesheet" href="<?php echo css_dir; ?>theme.css?<?php echo time(); ?>" type="text/css">
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
    <section class="creation-container">
        <!-- Image à gauche + Titre + Auteur dans même bloc rouge -->
        <div class="creation-image-box">
    <?php if (!empty ($portfolio['cover'])) { ?>
        <img src="<?php echo img_dir; ?>imgCreation/lg/<?=$portfolio['cover'];?>" alt="<?php echo $portfolio['title']; ?>" class="creation-image" />
    <?php } ?>
            <div class="title-author-block">
                <h1><?php echo $portfolio['title']; ?></h1>
                <p class="creation-author">Dessiné par Alvyn Boulay</p>
            </div>
        </div>

        <!-- Bloc contenu à droite (description + commentaires) -->
        <div class="content-right">
            <!-- Bloc description -->
            <section class="description-section">
                <h2 class="description-title">Description & inspirations :</h2>
                <p><?php echo $portfolio['description']; ?></p>
            </section>

            <!-- Bloc commentaires -->
            <section class="comments-slider-section">
                <h3 class="comments-title">Commentaires :</h3>
                <div class="comments-slider">
                    <!-- Premier commentaire -->
                    <div class="comment-slide active-slide">
                        <img src="assets/images/account_circle.png" alt="Avatar" class="comment-avatar" />
                        <div class="comment-content">
                            <strong class="comment-author">ExempleCommentaire</strong>
                            <p class="comment-text">Bien</p>
                        </div>
                    </div>

                    <!-- Deuxième commentaire -->
                    <div class="comment-slide">
                        <img src="assets/images/account_circle.png" alt="Avatar" class="comment-avatar" />
                        <div class="comment-content">
                            <strong class="comment-author">Autre personne</strong>
                            <p class="comment-text">je suis un commentaire.</p>
                        </div>
                    </div>
                </div>

                <div class="slider-controls">
                    <button id="prevComment">←</button>
                    <button id="nextComment">→</button>
                </div>

                <div class="comment-form-container">
                    <textarea id="commentText" placeholder="commentaire..." class="comment-textarea"></textarea>
                    <button id="addCommentBtn" class="comment-submit">Ajouter un commentaire</button>
                </div>
            </section>
        </div>
       
    </section>
    <?php include ('templates/footer.php'); ?>

    <div class="layer"></div>
    <script async src="<?php echo js_dir; ?>theme.js?<?php echo time(); ?>"></script>
    <script src="assets/scripts/btnRetourEnHaut.js?<?php echo time(); ?>"></script>
    <script src="assets/scripts/galeriedapercu.js?<?php echo time(); ?>"></script>
</body>

</html>