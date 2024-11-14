document.addEventListener('DOMContentLoaded', function() {
    console.log('serie.js chargé !');
    
    const serieUrl = `https://api.themoviedb.org/3/tv/popular?api_key=ea22993e5b3ec7acfb93c59ddf265f8c&language=fr-FR`;

    fetch(serieUrl)
        .then(response => response.json())
        .then(data => {
            console.log('Réponse de l\'API:', data); // Vérifiez la réponse de l'API
            if (data && data.results) {
                const serieDetailsContainer = document.querySelector('#serie');
                serieDetailsContainer.innerHTML = ''; // Réinitialiser le conteneur avant d'y ajouter de nouvelles séries

                // Afficher chaque série
                data.results.forEach(serie => {
                    const imageUrl = serie.poster_path ? `https://image.tmdb.org/t/p/w500/${serie.poster_path}` : 'default-image.jpg';

                    // Créer l'élément pour chaque série
                    const serieElement = document.createElement('div');
                    serieElement.classList.add('serie'); // Classe CSS pour personnaliser l'affichage

                    serieElement.innerHTML = `
                        <img src="${imageUrl}" alt="Affiche de la série ${serie.name}">
                        <h2>${serie.name}</h2>
                    `;

                    // Ajouter un gestionnaire d'événement pour rediriger vers la page de détails de la série
                    serieElement.addEventListener('click', function() {
                        window.location.href = `detail/${serie.id}/serie`; // Redirection vers la page de détail
                    });

                    // Ajouter l'élément de la série au conteneur
                    serieDetailsContainer.appendChild(serieElement);
                });
            } else {
                console.error('Aucune série trouvée.');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des séries populaires:', error);
        });
});
