<?php
require_once __DIR__ . '../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();

$googleMapsApiKey = $_ENV['GOOGLE_MAPS_API_KEY'];
require_once __DIR__ . './get_token.php'; // Adapte le chemin

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Nettoie toute sortie précédente pour éviter les erreurs JSON
ob_clean();
flush();

$google_api_key = $googleMapsApiKey; // Mets ta clé ici

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Données JSON non reçues.", "raw_data" => file_get_contents("php://input")]);
    die();
}

if (!isset($data["depart"]) || !isset($data["arrivee"])) {
    echo json_encode(["success" => false, "message" => "Adresses manquantes."]);
    die();
}

// Construire l'URL de Distance Matrix API
$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . urlencode($data["depart"]) .
       "&destinations=" . urlencode($data["arrivee"]) .
       "&mode=driving&key=" . $google_api_key;

$response = file_get_contents($url);
$result = json_decode($response, true);

if ($result["status"] === "OK" && isset($result["rows"][0]["elements"][0]["distance"]["value"])) {
    $distance_meters = $result["rows"][0]["elements"][0]["distance"]["value"];
    $distance_km = $distance_meters / 1000; // Conversion en km

    // Grille tarifaire
    $prix = 50;
    if ($distance_km > 20) {
        if ($distance_km <= 30) $prix = 60;
        elseif ($distance_km <= 40) $prix = 70;
        elseif ($distance_km <= 50) $prix = 80;
        elseif ($distance_km <= 60) $prix = 90;
        elseif ($distance_km <= 70) $prix = 100;
        elseif ($distance_km <= 80) $prix = 110;
        elseif ($distance_km <= 90) $prix = 120;
        elseif ($distance_km <= 100) $prix = 130;
        else $prix = 130 + ($distance_km - 100) * 1.25; // 1.25 € par km au-delà de 100 km
    }

    echo json_encode([
        "success" => true,
        "prix" => round($prix, 2),
        "distance_km" => round($distance_km, 2) // Ajout de la distance
    ]);
    
} else {
    echo json_encode(["success" => false, "message" => "Erreur API Distance Matrix.", "details" => $response]);
}

die(); // Important pour éviter toute sortie supplémentaire

?>
