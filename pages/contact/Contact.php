<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= htmlspecialchars("Contact | DriveShuttel's") ?></title>
    <meta name="description" content="Contactez DriveShuttel's pour vos demandes de réservation ou toute question. Nous sommes à votre écoute par email, téléphone ou réseaux sociaux.">
    <meta name="keywords" content="contact, DriveShuttel's, réservation, transport, chauffeur privé, devis, email, téléphone">
    <meta name="author" content="DriveShuttel's">

    <!-- Open Graph -->
    <meta property="og:title" content="Contact | DriveShuttel's">
    <meta property="og:description" content="Besoin d'aide ou d'informations ? Contactez DriveShuttel's par mail, téléphone ou via nos réseaux sociaux.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://tonsite.com/contact.php"> <!-- à modifier -->
    <meta property="og:image" content="https://tonsite.com/images/contact-cover.jpg"> <!-- à modifier -->

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