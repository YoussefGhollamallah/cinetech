<?php

session_start();

use App\Controllers\commentaireController;

// Instance de la classe Commentaire
$commentaire = new commentaireController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION['user']['id_user'])) {
        $id_user = $_SESSION['user']['id_user']; // ID de l'utilisateur connecté
        $content = htmlspecialchars($_POST['content']);
        $id_media = htmlspecialchars($_POST['id_media']);
        $type = htmlspecialchars($_POST['type']);

        try {
            $message = $commentaire->addComment(null, $content, $id_user, $id_media);
            echo "<p style='color: green;'>$message</p>";
        } catch (Exception $e) {
            echo "<p style='color: red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Vous devez être connecté pour ajouter un commentaire.</p>";
    }
}

// Récupération des commentaires pour ce média
$comments = $commentaire->getComments($media['id'], $type);

?>

<section class="details">
    <div id="card-detail">
        <div id="img-detail">
            <img src="https://image.tmdb.org/t/p/w300/<?= $media['poster_path'] ?>" alt="<?= htmlspecialchars($media['title'] ?? $media['name']) ?>">
        </div>
        <div id="detail-info">
            <h2><?= htmlspecialchars($media['title'] ?? $media['name']) ?></h2>
            <p><?= htmlspecialchars($media['overview']) ?></p>
            <p><?= isset($media['title']) ? 'Film' : 'Série' ?></p>

            <?php if (isset($media['release_date'])): ?>
                <p><strong>Date de sortie :</strong> <?= $media['release_date'] ?></p>
            <?php elseif (isset($media['first_air_date'])): ?>
                <p><strong>Date de première diffusion :</strong> <?= $media['first_air_date'] ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Carrousel des acteurs -->
    <div class="actors">
        <h3>Acteurs principaux :</h3>
        <?php if (!empty($media['cast'])): ?>
            <div class="carousel">
                <?php foreach ($media['cast'] as $actor): ?>
                    <?php if (isset($actor['profile_path']) && $actor['profile_path']): ?>
                        <div class="slide">
                            <img src="https://image.tmdb.org/t/p/w92/<?= $actor['profile_path'] ?>" alt="<?= htmlspecialchars($actor['name']) ?>">
                            <p><?= htmlspecialchars($actor['name']) ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucun acteur disponible.</p>
        <?php endif; ?>
    </div>

    <!-- Affichage du réalisateur avec photo uniquement -->
    <div class="directors">
        <h3>Réalisateur :</h3>
        <?php if (isset($media['crew'])): ?>
            <ul>
                <?php foreach ($media['crew'] as $crew): ?>
                    <?php if ($crew['job'] === 'Director' && isset($crew['profile_path']) && $crew['profile_path']): ?>
                        <li>
                            <img src="https://image.tmdb.org/t/p/w92/<?= $crew['profile_path'] ?>" alt="<?= htmlspecialchars($crew['name']) ?>">
                            <p><?= htmlspecialchars($crew['name']) ?></p>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun réalisateur disponible.</p>
        <?php endif; ?>
    </div>

      <!-- Affichage des commentaires -->
      <div id="comments">
        <h3>Commentaires</h3>
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p><strong><?= htmlspecialchars($comment['firstname'] . ' ' . $comment['lastname']) ?></strong> - <?= htmlspecialchars($comment['created_at']) ?></p>
                    <p><?= htmlspecialchars($comment['content']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun commentaire pour l'instant.</p>
        <?php endif; ?>
    </div>

    <!-- Formulaire pour ajouter un commentaire -->
    <?php if (isset($_SESSION['user']['id_user'])): ?>
        <section id="add-comment">
            <h3>Laisser un commentaire</h3>
            <form action="" method="POST">
                <textarea name="content" rows="50"  placeholder="Votre commentaire..." required></textarea>
                <input type="hidden" name="id_media" value="<?= htmlspecialchars($media['id']) ?>">
                <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">
                <button type="submit">Envoyer</button>
            </form>
        </section>
    <?php else: ?>
        <p>Veuillez <a href="<?= HOST ?>login">vous connecter</a> pour ajouter un commentaire.</p>
    <?php endif; ?>
</section>


<script>
    // Dupliquer les slides pour un défilement continu
    const carousel = document.querySelector('.carousel');
    carousel.innerHTML += carousel.innerHTML;
</script>
