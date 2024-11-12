document.addEventListener('DOMContentLoaded', function() {
    console.log('film.js chargé !');
    const filmUrl = `https://api.themoviedb.org/3/movie/popular?api_key=ea22993e5b3ec7acfb93c59ddf265f8c&language=fr-FR`;

    fetch(filmUrl)
        .then(response => response.json())
        .then(data => {
            if (data && data.results) {
                const filmDetailsContainer = document.querySelector('#film');
                filmDetailsContainer.innerHTML = ''; // Réinitialise le conteneur avant d'ajouter les films

                // Parcourt tous les films dans la réponse et affiche les détails de chacun
                data.results.forEach(film => {
                    const imageUrl = film.poster_path ? `https://image.tmdb.org/t/p/w500/${film.poster_path}` : 'default-image.jpg';

                    // Création de la structure HTML pour chaque film
                    const filmElement = document.createElement('div');
                    filmElement.classList.add('film'); // Optionnel : vous pouvez ajouter une classe CSS pour personnaliser l'affichage

                    filmElement.innerHTML = `
                        <img src="${imageUrl}" alt="Affiche du film ${film.title}">
                        <h2>${film.title}</h2>
                    `;

                    // Ajoute chaque film au conteneur
                    filmDetailsContainer.appendChild(filmElement);
                });
            } else {
                console.error('Aucun détail disponible pour les films.');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des films populaires:', error);
        });
});
