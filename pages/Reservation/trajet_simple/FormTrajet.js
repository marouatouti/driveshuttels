
    
    // Par défaut, le type de véhicule est "Berline"
    document.getElementById("vehicule").value = "economic"; 
    document.getElementById("vehicule_retour").value = "economic"; 

    document.getElementById("vehicule").addEventListener("change", function() {
        fetchDistanceAndPrice(); // Recalculer le prix avec le nouveau type de véhicule
    });

    document.getElementById("showRetour").addEventListener("change", function() {
        const sectionRetour = document.getElementById("sectionRetour");
        sectionRetour.style.display = this.checked ? "block" : "none";
    });






{/* Intégration de Google Maps API avec Places  */}
 

let departAutocomplete, arriveeAutocomplete;
    let departRetourAutocomplete, arriveeRetourAutocomplete;

    function initAutocomplete() {
        const options = {
            componentRestrictions: { country: "FR" }
        };

        // ALLER
        const departInput = document.getElementById("depart");
        const arriveeInput = document.getElementById("arrivee");

        if (departInput && arriveeInput) {
            departAutocomplete = new google.maps.places.Autocomplete(departInput, options);
            arriveeAutocomplete = new google.maps.places.Autocomplete(arriveeInput, options);

            departAutocomplete.addListener("place_changed", fetchDistanceAndPrice);
            arriveeAutocomplete.addListener("place_changed", fetchDistanceAndPrice);
        }

        // RETOUR
        const departRetourInput = document.getElementById("depart_retour");
        const arriveeRetourInput = document.getElementById("arrivee_retour");

        if (departRetourInput && arriveeRetourInput) {
            departRetourAutocomplete = new google.maps.places.Autocomplete(departRetourInput, options);
            arriveeRetourAutocomplete = new google.maps.places.Autocomplete(arriveeRetourInput, options);

            // Si tu veux aussi un fetchDistanceAndPrice pour le retour, ajoute ici
            departRetourAutocomplete.addListener("place_changed", fetchDistanceAndPriceRetour);
            arriveeRetourAutocomplete.addListener("place_changed", fetchDistanceAndPriceRetour);
        }
    }
    console.warn = function() {};
    // console.error = function() {};
    
    // Tu dois définir cette fonction si tu veux gérer le calcul du prix du retour
    function fetchDistanceAndPrice() {
        
    let depart = document.getElementById("depart").value;
    let arrivee = document.getElementById("arrivee").value;
    let vehicule = document.getElementById("vehicule").value; // Récupérer le type de véhicule choisi

    if (!depart || !arrivee) {
        console.warn("Les adresses aller ne sont pas correctement renseignées.");
        return;
    }

    fetch("../../../app/controllers/calcul_prix.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ depart: depart, arrivee: arrivee })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let prix = data.prix;

            // Calcul du prix en fonction du véhicule
            if (vehicule !== "economic") { // Si ce n'est pas une berline (type "economic")
                prix = calculPrixVehicule(data.distance_km);
            }

            document.getElementById("prixAllerAffiche").innerText =
                `Aller : ${data.distance_km} km | Prix : ${prix} €`;

            document.getElementById("distance_km").value = data.distance_km;
            document.getElementById("prix").value = prix;

            updatePrixTotal();
        } else {
            document.getElementById("prixAllerAffiche").innerText = "Erreur aller : " + data.message;
        }
    })
    .catch(error => console.error("Erreur Fetch (aller) :", error));
}

// Fonction pour calculer le prix en fonction du véhicule (van ou autre)
function calculPrixVehicule(distance) {
    if (distance <= 45) {
        return 90; // 1-45 km = 90 €
    } else if (distance <= 50) {
        return 100; // 45-50 km = 100 €
    } else {
        return 2 * distance; // 50 km et plus = 2€ par km
    }
}











    document.getElementById("vehicule_retour").addEventListener("change", fetchDistanceAndPriceRetour);

function fetchDistanceAndPriceRetour() {
    let depart = document.getElementById("depart_retour").value;
    let arrivee = document.getElementById("arrivee_retour").value;
    let vehiculeRetour = document.getElementById("vehicule_retour").value;

    if (!depart || !arrivee) {
        console.warn("Les adresses retour ne sont pas correctement renseignées.");
        return;
    }

    fetch("../../../app/controllers/calcul_prix.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ depart: depart, arrivee: arrivee })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let prixRetour = data.prix;

            if (vehiculeRetour !== "economic") {
                prixRetour = calculPrixVehicule(data.distance_km);
            }

            document.getElementById("prixRetourAffiche").innerText =
                `Retour : ${data.distance_km} km | Prix : ${prixRetour} €`;

            document.getElementById("distance_km_retour").value = data.distance_km;
            document.getElementById("prix_retour").value = prixRetour;

            updatePrixTotal();
        } else {
            document.getElementById("prixRetourAffiche").innerText = "Erreur retour : " + data.message;
        }
    })
    .catch(error => console.error("Erreur Fetch (retour) :", error));
}
function updatePrixTotal() {
    let prixAller = parseFloat(document.getElementById("prix").value) || 0;
    let prixRetour = parseFloat(document.getElementById("prix_retour").value) || 0;
    let total = prixAller + prixRetour;

    document.getElementById("prixTotalAffiche").innerText = `Total : ${total} €`;
}




// function updatePrixTotal() {
//     const prixAller = parseFloat(document.getElementById("prix").value) || 0;
//     const prixRetour = parseFloat(document.getElementById("prix_retour").value) || 0;
//     const total = prixAller + prixRetour;

//     if (total > 0) {
//         document.getElementById("prixTotalAffiche").innerText = `Total : ${total.toFixed(2)} €`;
//     } else {
//         document.getElementById("prixTotalAffiche").innerText = "";
//     }
// }









document.getElementById("btnReserver").addEventListener("click", function() {
    // Vérification des champs obligatoires
    const requiredFields = document.querySelectorAll("[required]"); // Sélectionne tous les champs obligatoires
    let isValid = true;
    let missingFields = []; // Pour garder une trace des champs manquants

    requiredFields.forEach(field => {
        const label = document.querySelector(`label[for="${field.id}"]`); // Trouve le label associé au champ

        if (!field.value.trim()) {
            isValid = false;
            missingFields.push(label ? label.innerText : field.name); // Ajoute le nom du champ à la liste des manquants
            if (label) {
                label.style.color = "red"; // Met le label en rouge
            }
        } else {
            if (label) {
                label.style.color = ""; // Réinitialise la couleur si le champ est valide
            }
        }
    });

    if (!isValid) {
        alert("Veuillez remplir les champs obligatoires : " + missingFields.join(", "));
        return; // Arrête la soumission si un champ obligatoire n'est pas rempli
    }

    const paymentMethod = document.querySelector('input[name="payment"]:checked');
    if (!paymentMethod) {
        alert("Veuillez choisir un mode de paiement.");
        return;
    }

    if (paymentMethod.value === "online") {
        const form = document.querySelector("form");

        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        fetch("../../../app/controllers/paiement/create_stripe_session.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.url) {
                window.location.href = data.url;
            } else {
                alert("Erreur lors de la création de la session Stripe : " + data.error);
            }
        })
        .catch(error => {
            alert("Erreur serveur.");
        });

    } else if (paymentMethod.value === "cash") {
        // Si paiement en espèces, soumettre le formulaire normalement
        const form = document.querySelector("form");
        form.submit(); // Soumission du formulaire classique
    }
});


