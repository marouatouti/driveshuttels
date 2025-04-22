<?php
require_once __DIR__ . "../../../vendor/autoload.php";
function getGoogleOAuthToken() {


    $path = "C:/wamp64/www/DriveShuttels/app/views/Reservation/driveShuttelRoutes.json";

    echo "Chemin attendu : " . $path . "<br>";
    echo "Chemin réel détecté : " . realpath($path) . "<br>";

    if (file_exists($path)) {
        echo "✅ Le fichier existe et est accessible !";
    } else {
        echo "❌ Erreur: Le fichier JSON d'authentification n'existe pas.";
    }


    
    putenv("GOOGLE_APPLICATION_CREDENTIALS=" . $path);

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->addScope("https://www.googleapis.com/auth/maps-platform.routes.compute");

    if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithAssertion();
    }

    $accessToken = $client->getAccessToken();
    return $accessToken['access_token'] ?? null;
}

echo getGoogleOAuthToken();
?>