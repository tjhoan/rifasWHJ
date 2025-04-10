document.addEventListener('DOMContentLoaded', () => {
    const numbers = document.querySelectorAll('.number');
    numbers.forEach(number => {
        number.addEventListener('click', () => {
            number.classList.toggle('selected');
        });
    });

    const searchButton = document.querySelector('.search-button');
    searchButton.addEventListener('click', () => {
        alert('Función de búsqueda no implementada.');
    });
});