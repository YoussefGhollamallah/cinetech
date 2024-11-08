document.addEventListener('DOMContentLoaded', function() {
    const serieContainer = document.querySelector('#serie');

    fetch(serieUrl)
        .then(response => response.json())
        .then(data => {
            if (data && Array.isArray(data.results)) {
                data.results.forEach(serie => {
                    const serieElement = document.createElement('div');
                    serieElement.classList.add('serie');
                    serieElement.innerHTML = `
                        <img src="https://image.tmdb.org/t/p/w300/${serie.poster_path}" alt="${serie.name} Poster">
                        <h2>${serie.name}</h2>
                    `;
                    serieContainer.appendChild(serieElement);
                });
            } else {
                console.error('Structure des données inattendue:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching series:', error);
        });
});
