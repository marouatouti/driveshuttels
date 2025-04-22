<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars("Choisissez votre type de réservation | DriveShuttel's") ?></title>
    <meta name="description" content="Sélectionnez le type de service qui vous convient : trajet simple, chauffeur à l'heure ou autre. Réservez facilement avec DriveShuttel's.">
    <meta name="keywords" content="réservation, type de réservation, trajet simple, chauffeur privé, DriveShuttel's, VTC, navette, service de transport">
    <meta name="author" content="DriveShuttel's">

    <!-- Open Graph -->
    <meta property="og:title" content="Choisissez votre type de réservation | DriveShuttel's">
    <meta property="og:description" content="Faites votre choix entre les services proposés par DriveShuttel's : réservation par trajet ou à l'heure.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://tonsite.com/reservation/SelectReservation.php"> <!-- adapte avec ton URL -->
    <meta property="og:image" content="https://tonsite.com/images/type-reservation.jpg"> <!-- adapte avec ton image -->
    <link rel="stylesheet" href="../../../css/reset.css">
    <link rel="stylesheet" href="selectReservation.css">

</head>
<body>
<?php require_once "../../../includes/header/header.php"; ?>
<section class="selectReservation">
    <h1>Choisissez votre réservation</h1>
    <div class="grpReserv">
    <article class="SelectResevation1">
        <a href="http://localhost/driveshuttel_s/pages/Reservation/trajet_simple/FormTrajet.php">
            <div class="typeReservation">
                <img src="../../../images/selectReserv2.jpg" alt="femme en voiture">
                <h2>Réserver un trajet</h2>
            </div>
        
        </a>
        <div class="infoTypeReservation">
            <p>Planifiez un aller simple ou un aller-retour en tout simplicité</p>
        </div>
    </article>
    <article class="SelectResevation1">
        <a href="http://localhost/driveshuttel_s/pages/Reservation/chauffeur_prive/formServiceHeure.php">
            <div class="typeReservation">
                <img src="../../../images/selectReserv.jpg" alt="femme en voiture">
                <h2>Service à l'heure</h2>
            </div>
        
        </a>
        <div class="infoTypeReservation">
            <p>Profitez d'un véhicule à votre disposition avec chauffeur dédié</p>
        </div>
    </article>
    </div>

    
</section> 
</body>
</html>