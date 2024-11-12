<?php

require_once config . "api.php";

$url = API_FILM_TENDANCE_URL;

?>

<section>
    <h1>Films</h1>

    <div id="film"></div>
</section>

<script>
    var $filmUrl = "<?php echo $url; ?>";
</script>

<script src="<?php echo ASSETS; ?>js/film.js"></script>