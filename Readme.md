# CINETECH
Cinetech est un site web utilisant une API pour afficher des films et des séries fournis par[The Movie Database](https://www.themoviedb.org/signup).

## Installation
Pour configurer et utiliser le site, installez les dépendances et configurez la base de données comme suit:
```
composer install
mysql -u root -p cinetech < cinetech.sql
```

## Outils
Ce projet utilise l'API [The Movie Database](https://www.themoviedb.org/signup). Une fois inscrit, vous obtiendrez une API8KEY, qui vous permettra d'interagir avec les données.

Voici un exemple de configuration avec PHP :
```
<?php

define("API_KEY", "votre_api");
define("API_FILM_TENDANCE_URL", "https://api.themoviedb.org/3/trending/movie/week?language=fr-FR&api_key=" . API_KEY);
define("API_SERIE_TENDANCE_URL", "https://api.themoviedb.org/3/trending/tv/week?language=fr-FR&api_key=" . API_KEY);

?>
```

## Fonctionnalités
Le site propose actuellement les fonctionnalités suivantes : 
* Les utilisateurs peuvent parcourir les films et séries disponibles, consulter les détails d'un film ou d'une série.
* Possibilité de s'inscrire et de se connecter pour accéder à des fonctionnalités supplémentaires.
* Une fois connecté, un utilisateur peut :
    * Ajouter et supprimer des commentaires dans la page détails d'un film ou séries.
    * Ajouter des film ou séries à ses favoris pour un accès rapide.

Le site va proposé prochainement les fonctionnalités suivante :
* La possibilité de rechercher un film et des séries grâce à une barre de recherche.
* La possibilité de répondre à des commentaires d'autre utilisateurs.
* De pouvoir noté un film ou une série et de voir la moyenne des notes.