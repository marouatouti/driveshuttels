document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    const form = document.getElementById('feedback-form');
    const ratingInput = document.getElementById('ratingInput');
    let selectedRating = 0;

    // Sélection des étoiles
    stars.forEach(star => {
        star.addEventListener('click', () => {
            selectedRating = parseInt(star.dataset.rating);
            ratingInput.value = selectedRating;
            stars.forEach(s => s.classList.toggle('active', parseInt(s.dataset.rating) <= selectedRating));
        });
    });

    // Envoi du formulaire en AJAX
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const text = document.getElementById('review-text').value.trim();
        const submitBtn = document.querySelector('.submit-btn');

        if (name && text && selectedRating) {
            submitBtn.disabled = true; // Évite le double envoi

            try {
                const response = await fetch('avis.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest' // Indique une requête AJAX
                    },
                    body: JSON.stringify({ name, review_text: text, rating: selectedRating })
                });

                const data = await response.json();
                if (data.success) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else {
                    alert("Erreur: " + data.message);
                }
            } catch (error) {
                console.error("Erreur AJAX:", error);
                alert("Une erreur est survenue.");
            } finally {
                submitBtn.disabled = false; // Réactive le bouton
            }
        } else {
            alert("Veuillez remplir tous les champs.");
        }
    });
});