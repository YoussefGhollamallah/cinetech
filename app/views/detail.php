<section>
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
</section>

    <!-- Affichage du réalisateur avec photo uniquement -->
    <div class="directors">
        <h3>Réalisateur :</h3>
        <?php if (!empty($media['crew'])): ?>
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
</section>

<script>
    // Dupliquer les slides pour un défilement continu
    const carousel = document.querySelector('.carousel');
    carousel.innerHTML += carousel.innerHTML;
</script>
