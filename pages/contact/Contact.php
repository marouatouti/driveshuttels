<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta keywords -->
    <meta name="keywords" content="contact chauffeur privé, contact vtc, réserver chauffeur, questions vtc, service client chauffeur, service client vtc">
    
    <!-- Meta description -->
    <meta name="description" content="Contactez-nous pour toutes questions, réservations ou informations sur notre service de chauffeur privé à Paris. Réservez votre chauffeur VTC dès aujourd'hui.">
    
    <!-- Meta robots (indexer cette page) -->
    <meta name="robots" content="index, follow">

    <!-- Title -->
    <title>Contactez-nous - Chauffeur Privé à Paris | DriveShuttel’s</title>
    
    
    
    <!-- Canonical link -->
    <link rel="canonical" href="https://www.davidesite.com/contact">
    
    <!-- Open Graph -->
    <meta property="og:title" content="Contactez-nous - Chauffeur Privé à Paris | DriveShuttel’s">
    <meta property="og:description" content="Contactez-nous pour toutes questions, réservations ou informations sur notre service de chauffeur privé à Paris. Réservez votre chauffeur VTC dès aujourd'hui.">
    <meta property="og:image" content="http://localhost/driveshuttel_s/images/imgAccueil.png"> <!-- Remplacer par l'URL de l'image liée à la page -->
    <meta property="og:url" content="https://www.davidesite.com/contact">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="DriveShuttel’s">
    
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="contact.css">
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