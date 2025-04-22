<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php htmlspecialchars("Détails de votre réservation | DriveShuttel's") ?></title>
    <meta name="description" content="Consultez toutes les informations relatives à votre réservation DriveShuttel's : confirmation, paiement, conditions, et plus encore.">
    <meta name="keywords" content="réservation, informations, DriveShuttel's, transport, VTC, navette, confirmation, paiement">
    <meta name="author" content="DriveShuttel's">

    <!-- Open Graph -->
    <meta property="og:title" content="Information Réservation | DriveShuttel's">
    <meta property="og:description" content="Consultez les détails de votre réservation chez DriveShuttel's. Tout ce que vous devez savoir sur le processus de réservation.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://tonsite.com/reservation/ReservationInfo.php"> <!-- adapte à ton URL -->
    <meta property="og:image" content="https://tonsite.com/images/reservation-info.jpg"> <!-- adapte à ton image -->

    <link rel="stylesheet" href="../../../css/reset.css">
    <link rel="stylesheet" href="reservationInfo.css">
</head>
<body>
<?php include_once("../../../includes/header/header.php"); ?>
<section class="reservationInfo">
    <img src="../../../images/reservationInfo.png" alt="Image de voiture">
    <article class="reservationInfoBtn">
        <div class="InfoReserv">
            <h2>Réservez votre trajet en quelques clics ! Choisissez votre destination, sélectionnez votre véhicule, et profitez d'un service rapide et fiable.</h2>
        </div>
        <div class="imgReserv">
            <img src="../../../images/element/BtnReservation.png" alt="">
            <a href=" http://localhost/driveshuttel_s/pages/Reservation/reservation_select/selectReservation.php">
                <button>Réservez maintenant</button>
            </a>
        </div>
        
    </article>

</section>
</body>
</html>