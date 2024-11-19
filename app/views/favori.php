<?php
session_start();

use App\Controllers\FavorisController;

$favoris = [];

// Vérification de l'authentification
if (!isset($_SESSION['user']["id_user"])) {
    echo "Utilisateur non authentifié.";
    exit;
}

$userId = (int) $_SESSION['user']["id_user"];

try {
    $favoriController = new FavorisController();

    // Suppression si une requête POST est envoyée
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_favori'])) {
        $idFavori = (int) $_POST['id_favori'];
        $favoriController->deleteFavori($idFavori, $userId);
        header("Location: " . $_SERVER['PHP_SELF']); // Recharge la page pour voir les changements
        exit;
    }

    // Récupérer les favoris
    $favoris = $favoriController->getAllFavorisByID($userId);
} catch (Exception $e) {
    error_log("Erreur lors de la récupération ou suppression des favoris : " . $e->getMessage());
    $favoris = [];
}
?>

<section>
    <h1>Vos Favoris</h1>
    <?php if (!empty($favoris)): ?>
        <ul>
            <?php foreach ($favoris as $favori): ?>
                <li>
                    <?php echo htmlspecialchars($favori['title']); ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id_favori" value="<?php echo $favori['id_favori']; ?>">
                        <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce favori ?');">Supprimer</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Vous n'avez aucun favori.</p>
    <?php endif; ?>
</section>
<a href="<?php echo BASE_URL; ?>">Retour à l'accueil</a>
