document.addEventListener('DOMContentLoaded', function() {

    const serieUrl = `https://api.themoviedb.org/3/tv/popular?api_key=ea22993e5b3ec7acfb93c59ddf265f8c&language=fr-FR`;

    fetch(serieUrl)
        .then(response => response.json())
        .then(data => {
            if (data && data.results) {
                const serieDetailsContainer = document.querySelector('#serie');
                serieDetailsContainer.innerHTML = ''; // Réinitialise le conteneur avant d'ajouter les séries

                // Parcourt toutes les séries dans la réponse et affiche les détails de chacune
                data.results.forEach(serie => {
                    const imageUrl = serie.poster_path ? `https://image.tmdb.org/t/p/w500/${serie.poster_path}` : 'default-image.jpg';

                    // Création de la structure HTML pour chaque série
                    const serieElement = document.createElement('div');
                    serieElement.classList.add('serie'); // Optionnel : vous pouvez ajouter une classe CSS pour personnaliser l'affichage

                    serieElement.innerHTML = `
                        <img src="${imageUrl}" alt="Affiche de la série ${serie.name}">
                        <h2>${serie.name}</h2>
                    `;

                    // Ajoute chaque série au conteneur
                    serieDetailsContainer.appendChild(serieElement);
                });
            } else {
                console.error('Aucun détail disponible pour les séries.');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des séries populaires:', error);
        });

});