// script.js

// Initialiser la carte et définir la vue sur une latitude et une longitude avec un certain niveau de zoom
var map = L.map('map').setView([45.523064, -122.676483], 13);

// Ajouter une tuile de base OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Ajouter un marqueur à la carte
var marker = L.marker([45.523064, -122.676483]).addTo(map)
    .bindPopup('Un marqueur.<br> Portland, OR.')
    .openPopup();

    document.addEventListener('DOMContentLoaded', () => {
        // Initialiser la carte (comme montré ci-dessus)
    
        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', (event) => {
            const name = document.querySelector('#name').value;
            const email = document.querySelector('#email').value;
            const message = document.querySelector('#message').value;
    
            if (!name || !email || !message) {
                event.preventDefault();
                alert('Tous les champs doivent être remplis!');
            } else {
                alert('Formulaire soumis avec succès!');
            }
        });
    });
    