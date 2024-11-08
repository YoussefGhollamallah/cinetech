document.addEventListener('DOMContentLoaded', function() {
    const filmContainer = document.querySelector('#film');

    fetch(filmUrl)
        .then(response => response.json())
        .then(data => {
            if (data && Array.isArray(data.results)) {
                data.results.forEach(film => {
                    const filmElement = document.createElement('div');
                    filmElement.classList.add('film');
                    filmElement.innerHTML = `
                        <img src="https://image.tmdb.org/t/p/w300/${film.poster_path}" alt="${film.title} Poster">
                        <h2>${film.title}</h2>
                    `;
                    filmContainer.appendChild(filmElement);
                });
            } else {
                console.error('Structure des données inattendue:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching films:', error);
        });
});