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

if (!file_exists(__DIR__ . '../../../vendor/autoload.php')) {
    exit("Erreur : Fichier autoload introuvable.");
}

if (!class_exists(TransactionalEmailsApi::class)) {
    exit("Erreur : Classe TransactionalEmailsApi introuvable.");
}

function securiser($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = securiser($_POST['nom'] ?? '');
    $prenom = securiser($_POST['prenom'] ?? '');
    $email = securiser($_POST['email'] ?? '');
    $telephone = securiser($_POST['telephone'] ?? '');
    $depart = securiser($_POST['depart'] ?? '');
    $heure = securiser($_POST['heure'] ?? '');
    $duree = securiser($_POST['duree'] ?? '');
    $vehicule = securiser($_POST['vehicule'] ?? '');
    $personnes = securiser($_POST['personnes'] ?? '');
    $bagages = securiser($_POST['bagages'] ?? '');
    $vol = securiser($_POST['vol'] ?? '');
    $message = securiser($_POST['message'] ?? '');
    $pancarte = isset($_POST['pancarte']) ? 'Oui' : 'Non';
    $siege = isset($_POST['siege']) ? 'Oui' : 'Non';
    $rehausseur = isset($_POST['rehausseur']) ? 'Oui' : 'Non';

    // Validation des champs requis
    if (empty($nom) || empty($prenom) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($telephone) || empty($depart) || empty($heure) || empty($duree) || empty($vehicule)) {
        // echo "Erreur : Des informations requises sont manquantes ou incorrectes.";
        exit;
    }

    // Clé API de Brevo
    $apiKey = $brevoApiKey; 
    $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
    $client = new Client(['verify' => false]);
    $apiInstance = new TransactionalEmailsApi($client, $config);

    // Contenu de l'email avec tableau structuré
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

    <h2>Nouvelle demande de réservation Service à l'heure</h2>

    <h3>Informations personnelles</h3>
    <table>
        <tr><td>Nom</td><td>$nom $prenom</td></tr>
        <tr><td>Email</td><td>$email</td></tr>
        <tr><td>Téléphone</td><td>$telephone</td></tr>
    </table>

    <h3>Trajet</h3>
    <table>
        <tr><td>Départ</td><td>$depart</td></tr>
        <tr><td>Heure</td><td>$heure</td></tr>
        <tr><td>Durée</td><td>$duree</td></tr>
        <tr><td>Véhicule</td><td>$vehicule</td></tr>
        <tr><td>Personnes</td><td>$personnes</td></tr>
        <tr><td>Bagages</td><td>$bagages</td></tr>
    </table>

    <h3>Options supplémentaires</h3>
    <table>
        <tr><td>Numéro de vol</td><td>$vol</td></tr>
        <tr><td>Message</td><td>$message</td></tr>
        <tr><td>Pancarte</td><td>$pancarte</td></tr>
        <tr><td>Siège bébé</td><td>$siege</td></tr>
        <tr><td>Réhausseur</td><td>$rehausseur</td></tr>
    </table>
    ";

    // En-têtes pour l'email
    $headers = [
        'Message-ID' => '<' . uniqid() . '@driveshuttels.com>'
    ];

    $sendSmtpEmail = new SendSmtpEmail([
        'to' => [['email' => 'driveshuttles@gmail.com', 'name' => 'Commanditaire']],
        'sender' => ['email' => 'driveshuttles@gmail.com', 'name' => 'DriveShuttel’s'],
        'subject' => '📬 Nouvelle demande de réservation service à l\'heure - ' . date("Y-m-d") . ' ' . uniqid(),
        'htmlContent' => $emailContent,
        'headers' => $headers
    ]);

    // Envoi de l'email
    try {
        $apiInstance->sendTransacEmail($sendSmtpEmail);
        // echo "Mail envoyé avec succès";
    } catch (Exception $e) {
        // echo "Erreur lors de l'envoi : " . $e->getMessage();
        error_log($e->getTraceAsString()); // Log de l'erreur dans les logs du serveur
    }
    $success = true; // ou false si erreur
$message = $success ? "Réservation envoyée avec succès !" : "Une erreur est survenue lors de l'envoi de votre demande.";

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
