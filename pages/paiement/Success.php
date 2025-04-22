<?php
session_start();

require_once __DIR__ . '/../../vendor/autoload.php';
require_once '../../app/controllers/paiement/send_email/send_email_brevo.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();

$stripeSecretKey = $_ENV['STRIPE_SECRET_KEY'];
\Stripe\Stripe::setApiKey( $stripeSecretKey);

if (!isset($_GET['session_id'])) {
    echo "Session Stripe manquante.";
    exit;
}

try {
    $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);
    $metadata = $session->metadata;

    // Récupération des infos depuis Stripe
    $reservation = [
        'nom' => $metadata->nom ?? '',
        'prenom' => $metadata->prenom ?? '',
        'email' => $metadata->email ?? '',
        'depart' => $metadata->depart ?? '',
        'arrivee' => $metadata->arrivee ?? '',
        'date_depart' => $metadata->date_depart ?? '',
        'heure' => $metadata->heure ?? '',
        'vehicule' => $metadata->vehicule ?? '',
        'distance' => $metadata->distance ?? '',
        'trajet_retour' => $metadata->trajet_retour ?? 'Non',
        'mode_paiement' => $metadata->mode_paiement ?? 'Carte',
        'prix_total' => number_format($metadata->prix_total ?? 0, 2, ',', ' ') . ' €',
        'depart_retour' => $metadata->depart_retour ?? '',
        'arrivee_retour' => $metadata->arrivee_retour ?? '',
        'date_retour' => $metadata->date_retour ?? '',
        'heure_retour' => $metadata->heure_retour ?? '',
        'vehicule_retour' => $metadata->vehicule_retour ?? '',
        'prix_retour' => number_format($metadata->prix_retour ?? 0, 2, ',', ' ') . ' €',
        'vol' => $metadata->vol ?? '',
        'pancarte' => $metadata->pancarte ?? '',
        'siege' => $metadata->siege ?? '',
        'rehausseur' => $metadata->rehausseur ?? '',
        'message' => $metadata->message ?? '',
        'telephone' => $metadata->telephone ?? '',  // Ajout du téléphone
        'prix' => number_format($metadata->prix ?? 0, 2, ',', ' ') . ' €'  // Ajout du prix
    ];
    
    
    
    // Envoi du mail à DriveShuttels
    sendReservationEmail($reservation);

    // Définir les messages de succès
    $success = true;
    $message = "Réservation envoyée avec succès !";
} catch (\Exception $e) {
    $success = false;
    $message = "Erreur lors de l'envoi de la réservation : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: <?= $success ? '#e6ffed' : '#ffe6e6' ?>;
            text-align: center;
            padding: 50px;
        }
        .box {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            display: inline-block;
            animation: fadeIn 1s ease-in-out;
        }
        .success-icon, .error-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
        .success-icon {
            color: green;
        }
        .error-icon {
            color: red;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            background: <?= $success ? '#2ecc71' : '#e74c3c' ?>;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="<?= $success ? 'success-icon' : 'error-icon' ?>">
            <?= $success ? '✔️' : '❌' ?>
        </div>
        <h1><?= $success ? 'Merci !' : 'Oups...' ?></h1>
        <p><?= $message ?></p>
        <a class="btn" href="http://localhost/driveshuttel_s/">Retour à l’accueil</a>
    </div>
</body>
</html>