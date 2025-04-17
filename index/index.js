 /**************************************js for form reservation trajet *******************************/ 
 document.addEventListener('DOMContentLoaded', function() {
    const vehicleConfigs = {
        'economic': { maxPersons: 4, maxBaggage: 4 },
        'business': { maxPersons: 4, maxBaggage: 4 },
        'van-eco': { maxPersons: 8, maxBaggage: 13 },
        'van-business': { maxPersons: 8, maxBaggage: 13 }
    };
  
    const form = document.getElementById('bookingForm');
    const vehicleSelect = document.getElementById('vehicule');
    const personnesSelect = document.getElementById('personnes');
    const bagagesSelect = document.getElementById('bagages');
  
    function updateOptions(selectElement, maxValue) {
        selectElement.innerHTML = '<option value="">Sélectionnez</option>';
        for (let i = 1; i <= maxValue; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            selectElement.appendChild(option);
        }
    }
  
    vehicleSelect.addEventListener('change', function() {
        const selectedVehicle = this.value;
        
        if (selectedVehicle) {
            const config = vehicleConfigs[selectedVehicle];
            
            personnesSelect.disabled = false;
            bagagesSelect.disabled = false;
            
            updateOptions(personnesSelect, config.maxPersons);
            updateOptions(bagagesSelect, config.maxBaggage);
        } else {
            personnesSelect.disabled = true;
            bagagesSelect.disabled = true;
            
            personnesSelect.innerHTML = '<option value="">Sélectionnez</option>';
            bagagesSelect.innerHTML = '<option value="">Sélectionnez</option>';
        }
  
        // Reset selections
        personnesSelect.value = '';
        bagagesSelect.value = '';
    });
  
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        
        // Convert checkbox values to boolean
        data.pancarte = !!formData.get('pancarte');
        data.siege = !!formData.get('siege');
        data.rehausseur = !!formData.get('rehausseur');
        
        console.log('Form Data:', data);
    });
  
    // Add animation class to input groups when focused
    document.querySelectorAll('.input-group input, .input-group select, .input-group textarea').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
  });



/***script pour les button switch formulaire devis */
// Sélection des éléments HTML
document.addEventListener('DOMContentLoaded', () => {
    // Sélection des éléments HTML
    const trajetBtn = document.getElementById('trajet-btn');
    const serviceHeureBtn = document.getElementById('service-heure-btn');
    const trajetForm = document.getElementById('trajet-form');
    const serviceHeureForm = document.getElementById('service-heure-form');
  
    // Vérifie que les éléments existent avant d'ajouter des événements
    if (trajetBtn && serviceHeureBtn && trajetForm && serviceHeureForm) {
      // Fonction pour afficher le formulaire Trajet
      trajetBtn.addEventListener('click', () => {
        trajetForm.style.display = 'flex';
        serviceHeureForm.style.display = 'none';
  
        // Mettre à jour les styles des boutons
        trajetBtn.classList.add('active');
        serviceHeureBtn.classList.remove('active');
      });
  
      // Fonction pour afficher le formulaire Service à l'heure
      serviceHeureBtn.addEventListener('click', () => {
        trajetForm.style.display = 'none';
        serviceHeureForm.style.display = 'flex';
  
        // Mettre à jour les styles des boutons
        serviceHeureBtn.classList.add('active');
        trajetBtn.classList.remove('active');
      });
    } else {
      console.error('Un ou plusieurs éléments nécessaires sont manquants.');
    }
  });

  /***script pour l'affichage des section ***/
  document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll('.fade-in');

    // Fonction pour vérifier si une section est dans la vue
    const isSectionInView = (section) => {
        const rect = section.getBoundingClientRect();
        return rect.top < window.innerHeight && rect.bottom >= 0;
    };

    // Fonction pour activer l'animation
    const activateAnimation = () => {
        sections.forEach((section) => {
            if (isSectionInView(section)) {
                section.classList.add('visible');
            }
        });
    };

    // Vérifier à chaque défilement de la page
    window.addEventListener('scroll', activateAnimation);

    // Initialiser l'animation à l'entrée sur la page
    activateAnimation();
});


/***calcul devis avec google maps  ***/



function initAutocomplete() {
    const options = {
        types: ['geocode'],
        componentRestrictions: { country: "FR" }
    };

    const departInput = document.getElementById("depart");
    const arriveeInput = document.getElementById("arrivee");

    new google.maps.places.Autocomplete(departInput, options);
    new google.maps.places.Autocomplete(arriveeInput, options);
}

document.addEventListener("DOMContentLoaded", initAutocomplete);

document.getElementById("trajet-form").addEventListener("submit", function(e) {
    e.preventDefault();

    const depart = document.getElementById("depart").value;
    const arrivee = document.getElementById("arrivee").value;
    const vehicule = document.getElementById("propositions").value;

    const directionsService = new google.maps.DirectionsService();

    directionsService.route(
        {
            origin: depart,
            destination: arrivee,
            travelMode: google.maps.TravelMode.DRIVING,
        },
        function(response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                const distance_meters = response.routes[0].legs[0].distance.value;
                const distance_km = distance_meters / 1000;

                let prix = calculerPrix(distance_km, vehicule);

                document.getElementById("resultat").innerHTML = `
                    Distance : ${distance_km.toFixed(2)} km<br>
                    Prix estimé : ${prix.toFixed(2)} €
                `;
            } else {
                alert("Impossible de calculer l'itinéraire.");
            }
        }
    );
});

function calculerPrix(distance_km, vehicule) {
    let prix = 0;

    if (vehicule === "economique") {
        prix = 50;
        if (distance_km > 20) {
            if (distance_km <= 30) prix = 60;
            else if (distance_km <= 40) prix = 70;
            else if (distance_km <= 50) prix = 80;
            else if (distance_km <= 60) prix = 90;
            else if (distance_km <= 70) prix = 100;
            else if (distance_km <= 80) prix = 110;
            else if (distance_km <= 90) prix = 120;
            else if (distance_km <= 100) prix = 130;
            else prix = 130 + (distance_km - 100) * 1.25;
        }
    }

    if (vehicule === "vanecho") {
        if (distance_km <= 45) prix = 90;
        else if (distance_km <= 50) prix = 100;
        else prix = distance_km * 2;
    }

    return prix;
}


/*** contact Formulaire ***/
document.addEventListener('DOMContentLoaded', function () {
    const submitBtn = document.getElementById('submitBtn');
    const contactForm = document.getElementById('contactForm');

    // Fonction pour afficher un message personnalisé
    function showMessage(message, isSuccess = true) {
        const messageElement = document.getElementById('statusMessage');
        if (messageElement) {
            messageElement.textContent = message;
            messageElement.style.display = "block";
            messageElement.style.backgroundColor = isSuccess ? "#4CAF50" : "#f44336"; // Vert pour succès, rouge pour erreur
            messageElement.classList.remove('hide'); // Supprime la classe hide pour l'animation

            // Masquer le message après 3 secondes
            setTimeout(() => {
                messageElement.classList.add('hide');
                setTimeout(() => {
                    messageElement.style.display = "none";
                }, 300); 
            }, 3000);
        }
    }

    // Empêcher le rafraîchissement de la page lors du submit
    contactForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Empêche la soumission par défaut

        console.log("Form submission prevented");  // Ajout de log pour vérifier l'événement

        const name = document.getElementById('nom').value;
        const email = document.getElementById('email').value;
        const sujet = document.getElementById('sujet').value;
        const message = document.getElementById('messageInput').value;

        // Vérifier que tous les champs sont remplis
        if (!name || !email || !sujet || !message) {
            showMessage("Please fill in all required fields", false); // Afficher le message d'erreur
            return;
        }

        // Valider le format de l'email
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showMessage("Please enter a valid email address", false); // Afficher le message d'erreur
            return;
        }

        const data = {
            'Nom': name,
            'Email': email,
            'Sujet': sujet,
            'Message': message,
        };

        submitBtn.disabled = true;
        showMessage("Submitting..."); // Afficher un message de soumission

        var formDataString = new URLSearchParams(data).toString();

        // Envoyer les données au serveur
        fetch("https://script.google.com/macros/s/AKfycby0rZZBmljzWUIfhkBfQRvgCFGJQ4yFunCFssTJMwrKasYXp5sCHQtLxY0EDbluAryGIQ/exec", {
            method: "POST",
            body: formDataString,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded", 
            },
        })
        .then((response) => response.text())
        .then((text) => {
            console.log("Réponse du serveur:", text);
            showMessage("Data submitted successfully!");
            submitBtn.disabled = false;

            // Réinitialiser les champs du formulaire
            document.getElementById('nom').value = '';
            document.getElementById('email').value = '';
            document.getElementById('sujet').value = '';
            document.getElementById('messageInput').value = '';
        })
        .catch((error) => {
            console.error(error);
            showMessage("An error occurred while submitting the form.", false); 
            submitBtn.disabled = false;
        });
    });
});
