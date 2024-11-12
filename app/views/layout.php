<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function deconnexion()
{
    session_unset();
    session_destroy();
    header('Location:'. BASE_URL . 'index');
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'deconnexion') {
    deconnexion();
}

require_once config . "api.php";

$url = API_FILM_TENDANCE_URL;

?>

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
            </a>
        </div>
        <nav>

            <ul class="navLink">
                <li><a class="navItems" href="<?php echo HOST; ?>">Accueil</a></li>
                <li><a class="navItems" href="<?php echo HOST; ?>film">Films</a></li>
                <li><a class="navItems" href="<?php echo HOST; ?>serie">Série</a></li>
            </ul>

            <?php if (isset($_SESSION['user'])): ?>
                <ul class="navLink">
                    <li><a class="navItems" href="<?php echo HOST; ?>profile">Profil</a></li>
                    <li><a class="navItems" href="<?php echo HOST; ?>index?action=deconnexion">Déconnexion</a></li>
                </ul>
            <?php else: ?>
                <ul class="navLink">
                    <li><a class="navItems" href="<?php echo HOST; ?>login">Connexion</a></li>
                    <li><a class="navItems" href="<?php echo HOST; ?>register">Inscription</a></li>
                </ul>
            <?php endif; ?>

        </nav>
    </header>

    <div class="banner">

        <?php if(isset($_SESSION["user"])) :?>
            <p>Bonjour <?php echo $_SESSION["user"]["firstname"] . " " . $_SESSION["user"]["lastname"]; ?></p>
        <?php else: ?>
            <p>Bienvenue sur Cinetech</p>
        <?php endif; ?>

    </div>
    
    <main>
        <?php echo $contentPage; ?>  
    </main>


</body>
</html>