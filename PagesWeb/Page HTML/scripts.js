// script.js

document.addEventListener('DOMContentLoaded', () => {
    // Initialiser la carte
    var map = L.map('map').setView([45.8326, 6.8652], 9);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([45.8326, 6.8652]).addTo(map)
        .bindPopup('Mont Blanc')
        .openPopup();
});