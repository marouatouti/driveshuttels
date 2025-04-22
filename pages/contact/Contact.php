<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Meta Robots pour indexation -->
  <meta name="robots" content="index, follow">

  <!-- Title -->
  <title>FAQ - Chauffeur Privé à Paris | DriveShuttel’s</title>

  <!-- Meta Description -->
  <meta name="description" content="Découvrez les réponses aux questions fréquentes sur nos services de chauffeur privé à Paris, réservation de VTC, et transferts aéroport CDG/Orly avec DriveShuttel’s.">

  <!-- Meta Keywords -->
  <meta name="keywords" content="FAQ chauffeur privé Paris, questions fréquentes VTC, chauffeur privé, transfert aéroport CDG, transfert aéroport Orly, réservation chauffeur privé, chauffeur privé Paris, VTC Paris, service chauffeur à l'heure">

  <!-- Canonical URL -->
  <link rel="canonical" href="https://www.davidesite.com/faq">

  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="FAQ - Chauffeur Privé à Paris | DriveShuttel’s">
  <meta property="og:description" content="Découvrez les réponses aux questions fréquentes sur nos services de chauffeur privé à Paris, réservation de VTC, et transferts aéroport CDG/Orly avec DriveShuttel’s.">
  <meta property="og:image" content="http://localhost/driveshuttel_s/images/faq-image.png">
  <meta property="og:url" content="https://www.davidesite.com/faq">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="DriveShuttel’s">

  <!-- Favicon -->
  <link rel="icon" href="images/icon.png" type="image/x-icon">

  <!-- Reset CSS -->
  <link rel="stylesheet" href="css/reset.css">
  <!-- Ton style CSS principal -->
  <link rel="stylesheet" href="faq.css">
</head>

<?php include_once '../../includes/header/header.php'; ?>
<body>
    

    <section class="reservation-banner" aria-label="Bannière de réservation">
        <p>Pour obtenir un devis ou réserver en ligne en toute simplicité, cliquez ici !</p>
        <a href="/reservation/SelectReservation.php" class="reservation-btn">Réserver</a>
    </section>

    
        
    <div class="contact">
        <div class="contact-form-all">
            <div class="left-section">
                <h1 class="title">Contactez nous</h1>
                <p class="description">
                    We are honoured to receive your comments and suggestions. Please feel free to contact us :
                </p>
                <div class="social-icons">
                    <a href="#" class="social-icon">
                        <img src="https://api.iconify.design/lucide/facebook.svg" alt="Facebook">
                    </a>
                    <a href="https://www.instagram.com/" class="social-icon">
                        <img src="https://api.iconify.design/lucide/instagram.svg" alt="Instagram">
                    </a>
                    <a href="#" class="social-icon">
                        <img src="https://api.iconify.design/lucide/linkedin.svg" alt="LinkedIn">
                    </a>
                    <a href="#" class="social-icon">
                        <img src="https://api.iconify.design/lucide/twitter.svg" alt="Twitter">
                    </a>
                    
                </div>
            </div>
            <form class="contact-form" id="contactForm">
    <input type="text" id="nom" placeholder="Nom" required>
    <input type="email" id="email" placeholder="Email" required>
    <input type="text" id="sujet" placeholder="Sujet" required>
    <textarea id="messageInput" placeholder="Message" rows="5" required></textarea>
    <button type="submit" id="submitBtn">Envoyer</button>
</form>

<div id="statusMessage" class="hide" style="display:none; padding:10px; color:white; margin-top:10px; border-radius:5px;"></div>
        </div>
    </div>
    <div class="main-content">
        <h2>Où nous trouver ?</h2>
        
        <div class="contact-info">
            <p>📞 Telephone : +33........</p>
            <p>✉ Email : ......@gmail.com</p>
            
        </div>
    </div>
    <script src="contact.js"></script>

  </body>
</html>