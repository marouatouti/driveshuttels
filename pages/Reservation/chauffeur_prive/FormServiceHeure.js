console.warn = function() {};
function initAutocomplete() {
    const inputDepart = document.getElementById("depart");
    new google.maps.places.Autocomplete(inputDepart, {
        types: ["geocode"],
        componentRestrictions: { country: "fr" }
    });
}

// Initialise une fois que la page est chargée
window.addEventListener("load", initAutocomplete);