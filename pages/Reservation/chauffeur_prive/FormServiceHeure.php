<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

$googleMapsApiKey = $_ENV['GOOGLE_MAPS_API_KEY'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars("Réservez un chauffeur à l'heure | DriveShuttel's") ?></title>
  <meta name="description" content="Réservez un chauffeur privé à l'heure avec DriveShuttel's. Flexibilité, confort et professionnalisme pour tous vos déplacements.">
  <meta name="keywords" content="réservation, chauffeur à l'heure, VTC, transport privé, service personnalisé, DriveShuttel's">
  <meta name="author" content="DriveShuttel's">

  <!-- Open Graph -->
  <meta property="og:title" content="Réservez un chauffeur à l'heure | DriveShuttel's">
  <meta property="og:description" content="Profitez d'un service de transport flexible et haut de gamme avec réservation à l'heure.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://tonsite.com/reservation/FormServiceHeure.php"> <!-- adapte avec ton URL -->
  <meta property="og:image" content="https://tonsite.com/images/chauffeur-heure.jpg"> <!-- adapte avec ton image -->

  <link rel="stylesheet" href="../../../css/reset.css">
    <link rel="stylesheet" href="formServiceHeure.css">
</head>
<body>
    <?php require_once "../../../includes/header/header.php"; ?>
    <section class="container">
        <div class="form-container">
            <h1 class="form-title">Réservation Chauffeur privé</h1>
            
            <form id="bookingForm " id="bookingForm" action="../../../app/controllers/Reservation.php" method="POST">
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
                    <h2 class="section-title">Détail de la réservation </h2>
                    
                    <div class="grid-2">
                        <div class="input-group">
                            <input type="text" name="depart" id="depart" placeholder=" " required>
                            <label for="depart">Adresse</label>
                        </div>

                        
                    </div>

                    <div class="grid-2">
                        <div class="input-group">
                            <input type="time" name="heure" id="heure" placeholder=" " required>
                            <label for="heure">Heure de départ</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="duree" id="duree"
                            placeholder=" " required>
                            <label for="depart">Durée</label>
                        </div>
                        <div class="input-group">
                            <select name="vehicule" id="vehicule" required>
                                <option value="">Sélectionnez un véhicule</option>
                                <option value="economic">Berline</option>                          
                                <option value="van-eco">Van</option>
                            </select>
                            <label for="vehicule">Type de véhicule</label>
                        </div>
                    </div>

                    <div class="grid-2">
                        <div class="input-group">
                            <select name="personnes" id="personnes" disabled>
                                <option value="">Sélectionnez</option>
                            </select>
                            <label for="personnes">Nombre de Personne</label>
                        </div>

                        <div class="input-group">
                            <select name="bagages" id="bagages" disabled>
                                <option value="">Sélectionnez</option>
                            </select>
                            <label for="bagages">Nombre de bagages</label>
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

                <button type="submit" class="submit-button">Réserver</button>
            </form>
        </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= htmlspecialchars($googleMapsApiKey) ?>&libraries=places,directions" async defer></script>
<script src="formServiceHeure.js"></script>
</body>
</html>