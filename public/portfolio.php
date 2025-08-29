<?php 

require_once("../config/settings.php"); 

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=h, initial-scale=1.0" />
    <meta name="description" content="AB Créations - Accueil" />
    <title>AB créations - Portfolio</title>
    <link rel="shortcut icon" href="../images/logoabcreation.png" />
    <link rel="stylesheet" href="../dist/css/theme.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body data-page="portfolio">
            <div class="img-fond"></div>

           <?php include ('templates/header.php'); ?>

    <main>
        <div class="search-bar">
            <input type="text" placeholder="Rechercher..." />
            <button class="clear-button">×</button>
        </div>

        <section class="creations-list">
            <!-- cartes injectées ici -->
        </section>

        <nav class="pagination">
            <button class="prev-button">‹</button>
            <span class="page-buttons-container"></span>
            <button class="next-button">›</button>
        </nav>


    </main>
    <button id="scrollToTopBtn" class="scroll-to-top">↑</button>
    <footer class="footer">
        <section>
            <div>
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
        </section>
    </footer>
    <div class="layer"></div>
    <script async src="../dist/js/theme.js"></script>
    <script src="assets/scripts/btnRetourEnHaut.js"></script>
    <script src="assets/scripts/portfolio.js"></script>
    <script src="assets/scripts/pagination.js"></script>

</body>

</html>