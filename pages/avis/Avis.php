<?php
require_once '../../app/Config/Config.php';

// Vérifier si c'est une requête AJAX
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAjax) {
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);
    if (!empty($data['name']) && !empty($data['review_text']) && !empty($data['rating'])) {
        $stmt = $pdo->prepare("INSERT INTO avis (nom, temoignage, note) VALUES (:nom, :temoignage, :note)");
        $stmt->execute([
            ':nom' => htmlspecialchars($data['name']),
            ':temoignage' => htmlspecialchars($data['review_text']),
            ':note' => (int)$data['rating']
        ]);
        echo json_encode(['success' => true]);
        exit; 
    }
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit;
}

// Si ce n'est pas une requête AJAX, on affiche la page normalement

$reviews = $pdo->query("SELECT * FROM avis ORDER BY date_avis DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Meta SEO -->
    <meta name="keywords" content="avis clients, témoignages, expérience chauffeur privé, avis sur chauffeur privé, commentaires clients, témoignages DriveShuttles, feedback clients">
    <meta name="description" content="Découvrez les avis et témoignages de nos clients sur DriveShuttles. Partagez votre expérience et laissez un commentaire après votre trajet.">

    <!-- Robots -->
    <meta name="robots" content="index, follow">

    <!-- Title -->
    <title>Avis et Témoignages des Clients - DriveShuttles</title>

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Avis et Témoignages des Clients - DriveShuttles">
    <meta property="og:description" content="Découvrez les avis et témoignages de nos clients sur DriveShuttles. Partagez votre expérience et laissez un commentaire après votre trajet.">
    <meta property="og:url" content="https://www.tonsite.com/avis">
    <meta property="og:image" content="URL_de_l_image_de_partage_ici">
    <meta property="og:site_name" content="DriveShuttles">

    <!-- Canonical Link -->
    <link rel="canonical" href="https://www.tonsite.com/avis">

    
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="avis.css">
    
</head>
<body>
<?php include_once '../../includes/header/header.php'; ?>
<main>


<div class="title-section">
    <h1>DriveShuttles</h1>
    <p>Découvrez ce que nos clients disent de nous ! Partagez votre expérience.</p>
</div>

<div class="feedback-card">
    <h2>Votre Avis</h2>
    <form id="feedback-form">
        <input type="text" id="name" name="name" placeholder="Votre nom" required>
        <textarea class="textareaAVis" id="review-text" name="review_text" placeholder="Votre témoignage" required></textarea>
        <input type="hidden" name="rating" id="ratingInput" value="">

        <div class="rating">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <button type="button" class="star" data-rating="<?= $i ?>">★</button>
            <?php endfor; ?>
        </div>

        <button type="submit" class="submit-btn">Envoyer</button>
    </form>
</div>

<section class="reviews">
<h2>Avis de nos Clients</h2>
<div id="reviewsGrid" class="reviews-grid">

    <?php foreach ($reviews as $avis): 
        $initiales = strtoupper(substr($avis['nom'], 0, 2)); // Récupère la première lettre
        ?>
        <div class="review-card">
            <div class="review-stars">
                <?= str_repeat('★', $avis['note']) . str_repeat('☆', 5 - $avis['note']) ?>
            </div>
            <p class="review-text"><?= nl2br(htmlspecialchars($avis['temoignage'])) ?></p>
            <div class="review-footer">
                <div class="review-avatar"><?= $initiales ?></div>
                <div class="review-info">
                    <span class="review-name"><?= htmlspecialchars($avis['nom']) ?></span>
                    
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</section>

</main>
<script src="avis.js"></script>
</body>
</html>