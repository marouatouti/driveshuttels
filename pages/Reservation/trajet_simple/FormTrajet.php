<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

$googleMapsApiKey = $_ENV['GOOGLE_MAPS_API_KEY'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php htmlspecialchars("Réservation de trajet privé | DriveShuttel’s") ?></title>
    <meta name="description" content="Réservez facilement votre trajet privé avec chauffeur via DriveShuttel’s. Service rapide, fiable et professionnel.">
    <meta name="keywords" content="réservation trajet, chauffeur privé, transport VTC, service de transport, DriveShuttel’s, transfert aéroport, réservation VTC">
    <!-- Open Graph (Facebook, LinkedIn...) -->
    <meta property="og:title" content="Réservez votre trajet avec DriveShuttel’s">
    <meta property="og:description" content="Service de réservation VTC sur-mesure. Votre chauffeur privé en quelques clics.">
    <meta property="og:image" content="https://tonsite.com/assets/og-image.jpg">
    <meta property="og:url" content="https://tonsite.com/success_reservation.php">
    <meta property="og:type" content="website">
     <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Réservez votre trajet avec DriveShuttel’s">
    <meta name="twitter:description" content="Service de transport privé avec chauffeur. Rapide, fiable et simple.">
    <meta name="twitter:image" content="https://tonsite.com/assets/og-image.jpg">

    <link rel="stylesheet" href="../../../css/reset.css">
    <link rel="stylesheet" href="FormTrajet.css">
</head>
<body>
    <?php require_once "../../../includes/header/header.php"; ?>
    

<div class="container">
    <div class="form-container">
        <h1 class="form-title">Réservation d'un trajet</h1><br><br>
        
        <form id="bookingForm " id="bookingForm" action="../../../app/controllers/ReservationII.php" method="POST">
            <div class="form-section">
                <h2 class="section-title">Informations Personnel</h2>
                <div class="grid-2">
                    <div class="input-group">
                        <input type="text" name="nom" id="nom" placeholder=" " required>
                        <label for="nom">Nom</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="prenom" id="prenom" placeholder=" " required>
                        <label for="prenom">Prénom</label>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <input type="email" name="email" id="email" placeholder=" " required>
                        <label for="email">Adresse email</label>
                    </div>
                    <div class="input-group">
                        <input type="tel" name="telephone" id="telephone" placeholder=" " required>
                        <label for="telephone">Numéro de téléphone</label>
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <h2 class="section-title">Informations du trajet aller</h2>
                <div class="grid-2">
                    <div class="input-group">
                        <input type="text" name="depart" id="depart" placeholder=" " required>
                        <label for="depart">Adresse de départ</label>
                    </div>

                    <div class="input-group">
                        <input type="text" name="arrivee" id="arrivee" placeholder=" " required>
                        <label for="arrivee">Adresse d'arrivée</label>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <input type="date" name="date_aller" id="date_aller" placeholder=" " required>
                        <label for="date_aller">Date de départ</label>
                        
                    </div>
                    <div class="input-group">
                        <input type="time" name="heure_aller" id="heure_aller" placeholder=" " required>
                        <label for="heure_aller">Heure de départ</label>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <select name="vehicule" id="vehicule" required>
                            <option value="">Sélectionnez un véhicule</option>
                            <option value="economic" >Berline</option>                          
                            <option value="van-eco">Van</option>
                        </select>
                        <label for="vehicule">Type de véhicule</label>
                    </div>
                    <div class="input-group">
                        <select name="personnes" id="personnes" disabled>
                            <option value="">Sélectionnez</option>
                        </select>
                        <label for="personnes">Nombre de Personne</label>
                    </div>
                </div>
                <div class="grid-1">
                    <div class="input-group">
                        <select name="bagages" id="bagages" disabled>
                            <option value="">Sélectionnez</option>
                        </select>
                        <label for="bagages">Nombre de bagages</label>
                    </div>
                </div>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="showRetour" name="showRetour">
                <label for="showRetour">Je veux réserver un trajet retour</label>
            </div>

            <div class="form-section" id="sectionRetour" style="display: none;">
    <h2 class="section-title">Informations du trajet retour (facultatif)</h2>
    <div class="grid-2">
        <div class="input-group">
            <input type="text" name="depart_retour" id="depart_retour" placeholder=" ">
            <label for="depart_retour">Adresse de départ (retour)</label>
        </div>

        <div class="input-group">
            <input type="text" name="arrivee_retour" id="arrivee_retour" placeholder=" ">
            <label for="arrivee_retour">Adresse d'arrivée (retour)</label>
        </div>
    </div>
    <div class="grid-2">
        <div class="input-group">
            <input type="date" name="date_retour" id="date_retour" placeholder=" ">
            <label for="date_retour">Date de retour</label>
        </div>
        <div class="input-group">
            <input type="time" name="heure_retour" id="heure_retour" placeholder=" ">
            <label for="heure_retour">Heure de retour</label>
        </div>
    </div>
    <div class="grid-2">
        <div class="input-group">
            <select name="vehicule_retour" id="vehicule_retour">
                <option value="">Sélectionnez un véhicule</option>
                <option value="economic" >Berline</option>                          
                <option value="van-eco">Van</option>
            </select>
            <label for="vehicule_retour">Type de véhicule (retour)</label>
        </div>
        <div class="input-group">
            <select name="personnes_retour" id="personnes_retour" disabled>
                <option value="">Sélectionnez</option>
            </select>
            <label for="personnes_retour">Nombre de Personne (retour)</label>
        </div>
    </div>
    <div class="grid-1">
        <div class="input-group">
            <select name="bagages_retour" id="bagages_retour" disabled>
                <option value="">Sélectionnez</option>
            </select>
            <label for="bagages_retour">Nombre de bagages (retour)</label>
        </div>
    </div>
</div>

            <div class="form-section">
                    <h2 class="section-title">Information complémentaire</h2>
                    
                    <div class="grid-1">
                        <div class="input-group">
                            <input type="text" name="vol" id="vol" placeholder=" ">
                            <label for="vol">Numéro de vol/train</label>
                        </div>

                        <div class="input-group">
                            <textarea name="message" id="message" rows="3" placeholder=" "></textarea>
                            <label for="message">Message supplementaire...</label>
                        </div>
                    </div>

                    <div class="checkbox-section">
                        <div class="checkbox-group">
                            <input type="checkbox" name="pancarte" id="pancarte">
                            <label for="pancarte">Pancarte a votre nom</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" name="siege" id="siege">
                            <label for="siege">Siége bébé</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" name="rehausseur" id="rehausseur">
                            <label for="rehausseur">Réhausseur</label>
                        </div>
                    </div>
                </div>
            <!-- Nouvelle section pour afficher le prix estimé -->
            <div class="form-section">
                <h2 class="section-title">Prix de la réservation</h2>
                <p id="prixAllerAffiche"></p>
                <p id="prixRetourAffiche"></p>
                <p id="prixTotalAffiche" style="font-weight: bold;"></p>

                <input type="hidden" name="distance_km" id="distance_km">
                <input type="hidden" name="prix" id="prix">

                <input type="hidden" name="distance_km_retour" id="distance_km_retour">
                <input type="hidden" name="prix_retour" id="prix_retour">
            </div>


            
            <div class="payment-card">
                <h2>Select Payment Method</h2>
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment" value="online">
                        <div class="option-content">
                            <div class="option-header">
                                <div class="icon-container online">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                </div>
                                <div class="option-text">
                                    <h3>Online Payment</h3>
                                    <p>Pay securely with your card</p>
                                </div>
                                <div class="radio-indicator"></div>
                            </div>
                        </div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment" value="cash">
                        <div class="option-content">
                            <div class="option-header">
                                <div class="icon-container cash">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                                </div>
                                <div class="option-text">
                                    <h3>Cash Payment</h3>
                                    <p>Payement en espése </p>
                                </div>
                                <div class="radio-indicator"></div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            <button type="button" class = "btnreservation" id="btnReserver">Réserver</button>

        </form>
    </div>
</div>
<script
  src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsApiKey; ?>&libraries=places&callback=initAutocomplete"
  async defer
></script>


<script src="FormTrajet.js"></script>

</body>
</html>