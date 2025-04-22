<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$googleMapsApiKey = $_ENV['GOOGLE_MAPS_API_KEY'];



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="index, follow">
    <title>Chauffeur Privé à Paris - VTC, Transfert Aéroport & Service à l'Heure | DriveShuttel’s</title>
    <meta name="keywords" content="chauffeur privé Île-de-France, réservation VTC Paris, transport aéroport Paris, service chauffeur à l'heure, VTC pas cher Paris, van privé Paris, berline avec chauffeur, transfert aéroport CDG, VTC Orly, transport en ville Paris">
    <meta name="description" content="Réservez votre chauffeur privé à Paris avec DriveShuttel’s. Service VTC pas cher, transfert aéroport (CDG, Orly), et chauffeur à l’heure. Confort et tarifs transparents.">
    <meta name="author" content="DriveShuttel's">

    <link rel="canonical" href="https://www.davidesite.com" /> <!-- Remplace par l'URL de la page d'accueil -->

    <!-- balise open graph -->
    <meta property="og:title" content="Chauffeur Privé à Paris - VTC, Transfert Aéroport & Service à l'Heure | DriveShuttel’s">
    <meta property="og:description" content="Réservez votre chauffeur privé à Paris avec DriveShuttel’s. Service VTC pas cher, transfert aéroport (CDG, Orly), et chauffeur à l’heure. Confort et tarifs transparents.">
    <meta property="og:image" content="http://localhost/driveshuttel_s/images/imgAccueil.png">
    <meta property="og:url" content="https://www.davidesite.com"> <!-- Remplace par l'URL de la page d'accueil -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="DriveShuttel’s">

    


    <link rel="icon" href="images/icon.png" type="image/x-icon">

    <!-- 🔹 Favicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- 🔹 Feuilles de style -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="index/index.css">

</head>
<body>
    
<?php require_once "../includes/header/header.php"; ?>
    <?php //require_once '../includes/Whatsapp.php'; ?>

    <main>
        <section class="accueil">
            <img src="images/imgAccueil.png" alt="Vue de la rue de Paris avec circulation et véhicules privés">
            <article>
                <div class="formDevisAccueil">
                    <div class="form-switch">
                        <button id="trajet-btn" class="switch-btn active">Trajet</button>
                        <button id="service-heure-btn" class="switch-btn">Service à l'heure</button>
                    </div>

                    <!-- Formulaire Trajet -->
                    <form id="trajet-form" class="form" style="display: flex;">
                        <h2>Obtenez un devis pour <br>votre trajet</h2>
                        <input type="text" name="depart" id="depart" placeholder="Adresse de départ" required>
                        <input type="text" name="arrivee" id="arrivee" placeholder="Adresse d'arrivée" required>
                        <div class="separatorFormAccueil">
                            <input type="text" placeholder="Date de départ" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                            <input type="text" placeholder="Heure de départ" onfocus="(this.type='time')" onblur="(this.type='text')" required>
                        </div>
                        <input type="number" placeholder="Nombre de personnes" required>
                        <select class="selectorAccueilForm" id="propositions" name="option">
                            <option value="economique">Type de véhicule</option>
                            <option value="economique">Berline</option>
                            <option value="vanecho">Van</option>
                        </select>
                        <button type="submit" class="radiusDiffer">Obtenir un devis</button>
                        <div id="resultat"></div>
                    </form>

                    <!-- Formulaire Service à l'heure -->
                    <form id="service-heure-form" class="form" style="display: none;">
                        <h2>Chauffeur à l'heure</h2>
                        <input type="text" placeholder="Adresse" required>
                        <input type="number" placeholder="Durée en heures" required>
                        <input type="date" required>
                        <button type="submit">Obtenir un devis</button>
                    </form>
                </div>
            </article>
        </section>

        <section class="accueilInfo fade-in">
            <h1>Voyagez comme vous le souhaitez</h1>
            <div class="accueilInfoSeparator">
                <article class="infoPost">
                    <img src="images/imgInfo1.png" alt="Famille à l'aéroport prête à voyager">
                    <h2>Transport aéroport</h2>
                    <p>Réservez votre transport depuis ou vers l’aéroport en toute sérénité.</p>
                    <a href="#">En savoir plus</a>
                </article>
                <article class="infoPost">
                    <img src="images/imgInfo2.png" alt="Chauffeur professionnel prêt pour un service à l'heure">
                    <h2>Chauffeur à l’heure</h2>
                    <p>Réservez un chauffeur privé à l’heure selon vos besoins.</p>
                    <a href="#">En savoir plus</a>
                </article>
                <article class="infoPost">
                    <img src="images/imgInfo3.png" alt="Client se déplaçant en ville en véhicule privé">
                    <h2>Transport en ville</h2>
                    <p>Déplacez-vous librement en ville à tout moment.</p>
                    <a href="#">En savoir plus</a>
                </article>
            </div>
        </section>

        <section class="voitureInfo fade-in">
            <div class="voitureInfotitre">
                <h2>Confort et sécurité pour votre voyage</h2><br>
                <p>Véhicules avec licence et chauffeurs professionnels</p>
            </div>
            
            <div class="accueilInfoSeparator">
                <article class="voiturePost">
                    <img src="images/voiture1.png" alt="Berline noire premium">
                    <h3>Berline</h3>
                    <p>Jusqu'à 4 passagers et 4 bagages</p>
                </article>
                <article class="voiturePost">
                    <img src="images/voiture3.png" alt="Van spacieux pour groupe ou famille">
                    <h3>Van</h3>
                    <p>Jusqu'à 8 passagers et 13 bagages</p>
                </article>
            </div>
        </section>

        <section class="telInfo fade-in">
            <article class="telInfoTextTel fade-in">
                <div class="infoTel">
                    <img src="images/Tel1.png" alt="Téléphone avec interface de réservation">
                </div>
                <div class="infoText">
                    <div class="infoTextGroup">
                        <h2>Réservez rapidement et simplement</h2>
                        <p>Réservez votre trajet en quelques clics via notre plateforme intuitive.</p>
                        <a href="#"><button>En savoir plus</button></a>
                    </div>
                </div>
            </article>

            <article class="telInfoTextTel differTel fade-in">
                <div class="infoTel">
                    <img src="images/Tel2.png" alt="Service téléphonique disponible en continu">
                </div>
                <div class="infoText">
                    <div class="infoTextGroup">
                        <h2>Service disponible 7j/7</h2>
                        <p>Peu importe l’heure, notre équipe est prête à vous accompagner.</p>
                        <a href="#"><button>En savoir plus</button></a>
                    </div>
                </div>
            </article>

            <article class="telInfoTextTel fade-in">
                <div class="infoTel">
                    <img src="images/Tel3.png" alt="Affichage des prix sur mobile">
                </div>
                <div class="infoText">
                    <div class="infoTextGroup">
                        <h2>Tarifs transparents et abordables</h2>
                        <p>Profitez de nos prix clairs, sans surprise.</p>
                        <a href="#"><button>En savoir plus</button></a>
                    </div>
                </div>
            </article>
        </section>

        <?php //require_once "./app/views/includes/num-conter.php"; ?>
        <?php //require_once "./app/views/includes/FormContact.php"; ?>
    </main>
    <?php require_once "../includes/stat_container/stat_container.php"; ?>

    <section class="contactAccueil  conatctDiffer fade-in">
            <div class="contactGroup1">
                <div class="contactTitre">
                    <span class="line"></span>
                    <h1>Contactez-nous</h1>
                    <span class="line"></span>
                </div>

                <p>Nous sommes honorés de recevoir vos commentaires et suggestions. N'hésitez pas à nous contacter.</p>
                <div class="iconsAccueil">
                    <a href="#facebook"><i class="fa-brands fa-square-facebook" style="color: #ff6600;"></i></a>
                    <a href="#Instagram"><i class="fa-brands fa-square-instagram" style="color: #ff6600;"></i></a>
                    <a href="#linkedin"><i class="fa-brands fa-linkedin" style="color: #ff6600;"></i></a>
                </div>
            </div>
            <div class="contactGroup2">
            <form id="contactForm">
                <input type="text" id="nom" name="nom" placeholder="Nom" required>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="text" id="sujet" name="sujet" placeholder="Sujet" required>
                <textarea id="messageInput" name="message" cols="30" rows="10" placeholder="Message" required></textarea>
                <button type="submit" id="submitBtn">Envoyer</button>
                <div id="statusMessage" style="display: none; margin: 20px; font-weight: bold; color: white; padding: 8px; border-radius: 4px;"></div>
            </form>
        </div>
    </section>
    <?php require_once "../includes/footer/footer.php"; ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=<?= htmlspecialchars($googleMapsApiKey) ?>&libraries=places,directions" async
    defer></script>
    <?php require_once "../includes/whatsapp/whatsapp.php"; ?>
<script src="index/index.js"></script>

</body>
</html>