<?php
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use GuzzleHttp\Client;

require_once __DIR__ . '../../../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../../../');
$dotenv->load();



function sendReservationEmail($reservation) {
    $brevoApiKey = $_ENV['BREVO_API_KEY'];
    $apiKey = $brevoApiKey;

    $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
    $apiInstance = new TransactionalEmailsApi(new Client(), $config);

    // 📄 Formatage du contenu HTML
    $htmlContent = "
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
            .price {
                color: green;
                font-size: 16px;
                font-weight: bold;
            }
        </style>

        <h2>Nouvelle réservation Stripe - DriveShuttel's</h2>

        <h3>Informations personnelles</h3>
        <table>
            <tr><td>Nom</td><td>{$reservation['nom']} {$reservation['prenom']}</td></tr>
            <tr><td>Email</td><td>{$reservation['email']}</td></tr>
            <tr><td>Téléphone</td><td>{$reservation['telephone']}</td></tr>
        </table>

        <h3>Mode de paiement</h3>
        <table>
            <tr><td style='color: green;'>Méthode</td><td style='color: green;'><strong>" . ucfirst($reservation['mode_paiement']) . "</strong></td></tr>
        </table>

        <h3>Trajet Aller</h3>
        <table>
            <tr><td>Départ</td><td>{$reservation['depart']}</td></tr>
            <tr><td>Arrivée</td><td>{$reservation['arrivee']}</td></tr>
            <tr><td>Date</td><td>{$reservation['date_depart']}</td></tr>
            <tr><td>Heure</td><td>{$reservation['heure']}</td></tr>
            <tr><td>Véhicule</td><td>{$reservation['vehicule']}</td></tr>
            <tr><td>Distance</td><td>{$reservation['distance']} km</td></tr>
            <tr><td class='price'>Prix aller</td><td class='price'><strong>{$reservation['prix']} €</strong></td></tr>
        </table>

        <h3>Trajet Retour</h3>
        <table>
            <tr><td>Départ</td><td>{$reservation['depart_retour']}</td></tr>
            <tr><td>Arrivée</td><td>{$reservation['arrivee_retour']}</td></tr>
            <tr><td>Date</td><td>{$reservation['date_retour']}</td></tr>
            <tr><td>Heure</td><td>{$reservation['heure_retour']}</td></tr>
            <tr><td>Véhicule</td><td>{$reservation['vehicule_retour']}</td></tr>
            <tr><td class='price'>Prix retour</td><td class='price'><strong>{$reservation['prix_retour']} €</strong></td></tr>
        </table>

        <h3>Prix total</h3>
        <table>
            <tr><td class='price'>Total</td><td class='price'><strong>{$reservation['prix_total']} €</strong></td></tr>
        </table>

        <h3>Options supplémentaires</h3>
        <table>
            <tr><td>Numéro de vol/train</td><td>{$reservation['vol']}</td></tr>
            <tr><td>Pancarte</td><td>{$reservation['pancarte']}</td></tr>
            <tr><td>Siège bébé</td><td>{$reservation['siege']}</td></tr>
            <tr><td>Réhausseur</td><td>{$reservation['rehausseur']}</td></tr>
            <tr><td>Message</td><td>{$reservation['message']}</td></tr>
        </table>
    ";

    $sendSmtpEmail = new SendSmtpEmail([
        'subject' => "📬 Réservation trajet de " . $reservation['prenom'] . " " . $reservation['nom'] . " - " . date('d/m/Y ') .uniqid(),
        'htmlContent' => $htmlContent,
        'to' => [['email' => 'driveshuttles@gmail.com', 'name' => 'Commanditaire']],
        'sender' => ['email' => 'driveshuttles@gmail.com', 'name' => 'DriveShuttel’s'],
    ]);

    try {
        $apiInstance->sendTransacEmail($sendSmtpEmail);
        return true;
    } catch (Exception $e) {
        error_log('Erreur envoi email réservation : ' . $e->getMessage());
        return false;
    }
}
