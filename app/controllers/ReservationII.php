<?php

// Activer l'affichage des erreurs pour debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Charger les dépendances
require_once __DIR__ . '../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();

$brevoApiKey = $_ENV['BREVO_API_KEY'];

use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use GuzzleHttp\Client;
use Brevo\Client\Model\SendSmtpEmail;

if (!file_exists(__DIR__ . '/../../vendor/autoload.php')) {
    exit;
}

if (!class_exists(TransactionalEmailsApi::class)) {
    exit;
}

function securiser($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
$success = false;
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = securiser($_POST['nom'] ?? '');
    $prenom = securiser($_POST['prenom'] ?? '');
    $email = securiser($_POST['email'] ?? '');
    $telephone = securiser($_POST['telephone'] ?? '');
    
    // Aller
    $depart_aller = securiser($_POST['depart'] ?? '');
    $arrivee_aller = securiser($_POST['arrivee'] ?? '');
    $date_aller = securiser($_POST['date_aller'] ?? '');
    $heure_aller = securiser($_POST['heure_aller'] ?? '');
    $vehicule_aller = securiser($_POST['vehicule'] ?? '');
    $personnes_aller = securiser($_POST['personnes'] ?? '');
    $bagages_aller = securiser($_POST['bagages'] ?? '');

    // Retour
    $depart_retour = securiser($_POST['depart_retour'] ?? '');
    $arrivee_retour = securiser($_POST['arrivee_retour'] ?? '');
    $date_retour = securiser($_POST['date_retour'] ?? '');
    $heure_retour = securiser($_POST['heure_retour'] ?? '');
    $vehicule_retour = securiser($_POST['vehicule_retour'] ?? '');
    $personnes_retour = securiser($_POST['personnes_retour'] ?? '');
    $bagages_retour = securiser($_POST['bagages_retour'] ?? '');

    //prix et distance
    $distance_km = securiser($_POST['distance_km'] ?? '');
    $prix = securiser($_POST['prix'] ?? '');
    $prix_retour = securiser($_POST['prix_retour'] ?? '0');
    $prix = floatval($prix);
$prix_retour = floatval($prix_retour);

    $prix_total = $prix + $prix_retour;
    $payment_method = securiser($_POST['payment'] ?? 'Non spécifié');



    // Infos complémentaires
    $vol = securiser($_POST['vol'] ?? '');
    $message = securiser($_POST['message'] ?? '');
    $pancarte = isset($_POST['pancarte']) ? 'Oui' : 'Non';
    $siege = isset($_POST['siege']) ? 'Oui' : 'Non';
    $rehausseur = isset($_POST['rehausseur']) ? 'Oui' : 'Non';

     if (empty($nom) || empty($prenom) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($telephone) || empty($depart_aller) || empty($arrivee_aller) || empty($heure_aller) || empty($vehicule_aller)) {
         exit;
     }

    $apiKey = $brevoApiKey;
    $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
    $client = new Client(['verify' => false]);
    $apiInstance = new TransactionalEmailsApi($client, $config);

    $emailContent = "
    <style>
        table {
            width: 70%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        td, th {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        h3 {
           font-weight: bold;
            text-decoration: underline;
            font-family: Arial, sans-serif;
        }
        h2 {
            
            text-decoration: underline;
            font-family: Arial, sans-serif;
        }
    </style>

    <h2>Nouvelle demande de réservation</h2>

    <h3>Informations personnelles</h3>
    <table>
        
        <tr><td>Nom</td><td>$nom $prenom</td></tr>
        <tr><td>Email</td><td>$email</td></tr>
        <tr><td>Téléphone</td><td>$telephone</td></tr>
    </table>

    <h3>Mode de paiement</h3>
    <table>
        
        <tr><td style='color: green;'>Méthode</td><td style='color: green;'><strong>" . ucfirst($payment_method) . "</strong></td></tr>
    </table>

    <h3>Trajet Aller</h3>
    <table>
        
        <tr><td>Départ</td><td>$depart_aller</td></tr>
        <tr><td>Arrivée</td><td>$arrivee_aller</td></tr>
        <tr><td>Date</td><td>$date_aller</td></tr>
        <tr><td>Heure</td><td>$heure_aller</td></tr>
        <tr><td>Véhicule</td><td>$vehicule_aller</td></tr>
        <tr><td>Distance</td><td>$distance_km km</td></tr>
        <tr><td style='color: green;'>Prix aller</td><td style='color: green;'><strong>$prix €</strong></td></tr>
    </table>

    <h3>Trajet Retour</h3>
    <table>
        
        <tr><td>Départ</td><td>$depart_retour</td></tr>
        <tr><td>Arrivée</td><td>$arrivee_retour</td></tr>
        <tr><td>Date</td><td>$date_retour</td></tr>
        <tr><td>Heure</td><td>$heure_retour</td></tr>
        <tr><td>Véhicule</td><td>$vehicule_retour</td></tr>
        <tr><td style='color: green;'>Prix retour</td><td style='color: green;'><strong>$prix_retour €</strong></td></tr>
    </table>

    <h3>Prix total</h3>
    <table>
        
        <tr><td style='color: green; font-size: 16px;'>Total</td><td style='color: green; font-size: 16px;'><strong>$prix_total €</strong></td></tr>
    </table>

    <h3>Options supplémentaires</h3>
    <table>
        
        <tr><td>Numéro de vol/train</td><td>$vol</td></tr>
        <tr><td>Pancarte</td><td>$pancarte</td></tr>
        <tr><td>Siège bébé</td><td>$siege</td></tr>
        <tr><td>Réhausseur</td><td>$rehausseur</td></tr>
        <tr><td>Message</td><td>$message</td></tr>
    </table>
";





    $headers = [
        'Message-ID' => '<' . uniqid() . '@driveshuttels.com>'
    ];
    
    $sendSmtpEmail = new SendSmtpEmail([
        'to' => [['email' => 'driveshuttles@gmail.com', 'name' => 'Commanditaire']],
        'sender' => ['email' => 'driveshuttles@gmail.com', 'name' => 'DriveShuttel’s'],
        'subject' => "📬 Réservation trajet de " . $prenom . " " . $nom . " - " . date('d/m/Y ') . uniqid(),

        'htmlContent' => $emailContent,
        'headers' => $headers
    ]);
    
    // try {
    //     $response = $apiInstance->sendTransacEmail($sendSmtpEmail);
    //     var_dump($response);
    // } catch (Exception $e) {
    //     var_dump($e->getMessage());
    // }
    // die();

    

    try {
        $apiInstance->sendTransacEmail($sendSmtpEmail);
        $success = true;
        $message = "Réservation envoyée avec succès !";
    } catch (Exception $e) {
        $success = false;
        $message = "Erreur lors de l'envoi de la réservation : " . $e->getMessage();
    }
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