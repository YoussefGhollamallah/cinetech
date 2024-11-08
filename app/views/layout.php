<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>css/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo ASSETS; ?>picture/cinema.ico">
    <title><?php echo $title ?? "Cinetech" ?></title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="<?php echo HOST; ?>">
                <img src="<?php echo ASSETS; ?>picture/cinema.png" alt="logo">
            </a>i
        </div>
        <nav>

            <ul class="navLink">
                <li><a class="navItems" href="<?php echo HOST; ?>">Accueil</a></li>
                <li><a class="navItems" href="<?php echo HOST; ?>film">Films</a></li>
                <li><a class="navItems" href="<?php echo HOST; ?>serie">Série</a></li>
            </ul>
            <ul class="navLink">
                <li><a class="navItems" href="<?php echo HOST; ?>login">Connexion</a></li>
                <li><a class="navItems" href="<?php echo HOST; ?>register">Inscription</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php echo $contentPage; ?>  
    </main>

    <script>
        const filmUrl = <?php echo json_encode($url); ?>;
        const serieUrl = <?php echo json_encode($url); ?>;
    </script>
    <script src="<?php echo ASSETS; ?>js/film.js"></script>
    <script src="<?php echo ASSETS; ?>js/serie.js"></script>
</body>
</html>