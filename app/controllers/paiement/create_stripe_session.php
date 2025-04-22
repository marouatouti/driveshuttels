<?php
session_start();
require_once __DIR__ . '../../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../../');
$dotenv->load();

$stripeSecretKey = $_ENV['STRIPE_SECRET_KEY'];

\Stripe\Stripe::setApiKey($stripeSecretKey);

function securiser($valeur) {
    return htmlspecialchars(strip_tags(trim($valeur)));
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["error" => "Aucune donnée reçue"]);
    exit;
}

// Données principales
$nom = securiser($data['nom'] ?? '');
$prenom = securiser($data['prenom'] ?? '');
$email = securiser($data['email'] ?? '');
$telephone = securiser($data['telephone'] ?? '');
$depart = securiser($data['depart'] ?? '');
$arrivee = securiser($data['arrivee'] ?? '');
$date_depart = securiser($data['date_aller'] ?? '');
$heure = securiser($data['heure_aller'] ?? '');
$type_vehicule = securiser($data['vehicule'] ?? '');
$distance = securiser($data['distance_km'] ?? '');
$prix = floatval($data['prix'] ?? 0);
$prix_retour = floatval($data['prix_retour'] ?? 0);
$prix_total = ($prix + $prix_retour) * 100; // en centimes

// Retour
$depart_retour = securiser($data['depart_retour'] ?? '');
$arrivee_retour = securiser($data['arrivee_retour'] ?? '');
$date_retour = securiser($data['date_retour'] ?? '');
$heure_retour = securiser($data['heure_retour'] ?? '');
$vehicule_retour = securiser($data['vehicule_retour'] ?? '');

// Services
$vol = securiser($data['vol'] ?? '');
$pancarte = securiser($data['pancarte'] ?? '');
$siege = securiser($data['siege'] ?? '');
$rehausseur = securiser($data['rehausseur'] ?? '');
$message = securiser($data['message'] ?? '');

// Divers
// $chauffeur = securiser($data['chauffeur'] ?? '');
$trajet_retour = !empty($depart_retour) ? 'Oui' : 'Non';
$mode_paiement = 'Carte';
$type_reservation = 'Trajet simple'; // à adapter si besoin


if (empty($nom) || empty($prenom) || empty($email) || empty($depart) || empty($arrivee)) {
    echo json_encode(["error" => "Champs requis manquants."]);
    exit;
}

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'Réservation DriveShuttel\'s',
                    'description' => "Trajet de $depart à $arrivee"
                ],
                'unit_amount' => intval($prix_total),
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/driveshuttel_s/pages/paiement/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/driveshuttel_s/pages/paiement/annule.php',
        'metadata' => [
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'telephone' => $telephone,
        'depart' => $depart,
        'arrivee' => $arrivee,
        'date_depart' => $date_depart,
        'heure' => $heure,
        'vehicule' => $type_vehicule,
        'distance' => $distance,
        'trajet_retour' => $trajet_retour,
        'depart_retour' => $depart_retour ?? '',
        'arrivee_retour' => $arrivee_retour ?? '',
        'date_retour' => $date_retour ?? '',
        'heure_retour' => $heure_retour ?? '',
        'vehicule_retour' => $vehicule_retour ?? '',
        'prix_retour' => $prix_retour, // pas de division ici
        'prix_total' => $prix_total / 100,
        'mode_paiement' => $mode_paiement,
        'vol' => $vol ?? '',
        'pancarte' => $pancarte ?? '',
        'siege' => $siege ?? '',
        'rehausseur' => $rehausseur ?? '',
        'message' => $message ?? '',
        'prix' => $prix // pas de division ici
    ]
        ]);

    echo json_encode(['url' => $session->url]);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
