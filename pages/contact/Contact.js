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
