<?php

require_once __DIR__ . '/../backend/registerBe.php';
?>
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <!-- stylesheet for the page -->
    <link rel="stylesheet" href="../styles/app.css">
    <!-- Favicon (PNG et ICO pour compatibilité maximale) -->
    <link rel="icon" type="image/png" href="https://eco-ride.online/images/IconOnly_Transparent_NoBuffer-2-copie-32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        
    <title>Register to ecoride</title>
</head>

<body>

<?php include __DIR__ . '/../elements/navigation.php'; ?>


    <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <?php if ($success) : ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    
    <div class="form-container">
        <h1>Inscription à EcoRide</h1>
        <form action="" method="post" class="center flex p-10 " id="form-inscription" onsubmit="return validateForm()">
            <div class="form-control">
                <label for="nom"><strong>Nom:</strong></label>
                <input type="text" id="nom" name="nom" required>
                <label for="prenom"><strong>Prénom:</strong></label>
                <input type="text" id="prenom" name="prenom" required>
                <label for="prenom"><strong>Pseudo:</strong></label>
                <input type="text" id="pseudo" name="pseudo" required>
                <label for="email"><strong>Email:</strong></label>
                <input type="email" id="email" name="email" required>
                <label for="mot_de_passe"><strong>Mot de passe:</strong></label>
                <input type="password" id="password" name="password" required>
                <div id="password-feedback" style="color: red; font-size: 0.9em; margin-top: 5px;"></div>
                <label for="verif_mot_de_passe">Vérifiez le mot de passe:</label>
                <input type="password" id="verif_mot_de_passe" name="verif_mot_de_passe" required>
                <div id="password_error" class="error-message"></div>
                <label for="ville"><strong>Ville:</strong></label>
                <input type="text" id="ville" name="ville" required>
                <label for="adresse"><strong>Adresse:</strong></label>
                <input type="text" id="adresse" name="adresse" required>
                <label for="telephone"><strong>Numéro de téléphone:</strong></label>
                <input type="text" id="telephone" name="telephone" required>
                <label for="date_naissance"><strong>Date de naissance:</strong></label>
                <input type="date" id="date_naissance" class="form-control" name="date_naissance" max="2007-04-24" required></br>
            

            </div>

            <button type="submit" class="btn btn-primary mw-100 mt-20 w-100" name="submit">S'inscrire</button>
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const form = document.getElementById("form-inscription");

                form.addEventListener("submit", function(e) {
                    const password = document.getElementById('password').value;
                    const verifyPassword = document.getElementById('verif_mot_de_passe').value;
                    const passwordError = document.getElementById('password_error');

                    if (password !== verifyPassword) {
                        e.preventDefault(); // Stop le formulaire
                        passwordError.textContent = "Les mots de passe ne correspondent pas.";
                    } else {
                        passwordError.textContent = "";
                    }
                });
            });
            document.addEventListener("DOMContentLoaded", () => {
                const birthInput = document.getElementById("date_naissance");
                const today = new Date();
                const year = today.getFullYear() - 18;
                const month = String(today.getMonth() + 1).padStart(2, '0'); // mois 0-indexé
                const day = String(today.getDate()).padStart(2, '0');
                const maxDate = `${year}-${month}-${day}`;

                birthInput.max = maxDate;
            });
        </script>
    </div>
    <div class="container pt-200" style="margin-bottom:50px;">

        <h3>Foire aux questions</h3></br>


        <div class="accordion" id="accordionExample" style="color:#000000">
            <div class="accordion-item">
                <p class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Comment reserver un voyage ?
                    </button>
                </p>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body"></br>
                        <strong>Rendez vous sur la page co-voiturage</strong>, connectez-vous a la plateforme et
                        effectuer
                        votre premiere recherche, une fois un cocoiturage trouver, cliquer sur le bouton participer.
                        Rentrer
                        le nombre de place dint vous avez besoin, cliquez a nouveau sur confirmer et le tour est
                        joué.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <p class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Comment annuler un covoiturage ?
                    </button>
                </p>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body"></br>
                        <strong>Rendez vous sur votre profil</strong> descendez tout en bas de la page, dans la
                        section
                        "covoiturage en cours", cliquer sur annulez.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <p class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Comment poster un avis sur un covoiturage ?
                    </button>
                </p>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body"></br>
                        <strong>Une fois le covoiturage terminer</strong> rendez vous sur votre profil, descendez
                        tout en
                        bas dans la section "laissez un avis".
                    </div>
                </div>
            </div>
        </div></br></br></br>


        <div class="column">
            <div class="column-1">
                <h2>Merci de votre visite</h2></br>
                <img src="../images/communicate-2.png"
                    alt="image de trois logo de contact,email telephone et messagerie">
            </div>
            <div class="column-1">
                <form action="" method="post">
                    <fieldset>
                        <legend>Nous contacter</legend></br>

                        <label for="nom">Nom :</label></br>
                        <input type="text" id="nom" name="nom" required></br>

                        <label for="email">Email :</label></br>
                        <input type="email" id="email" name="email" required></br>

                        <label for="objet">Objet :</label></br>
                        <input type="text" id="objet" name="objet"></br>

                        <label for="message">Message :</label></br>
                        <textarea id="message" name="message" rows="5" required></textarea>

                        <button type="submit" name="formulaire_contact" id="button"> Envoyer</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <h1>ECORIDE</h1>
        <p>Designed by <span>Driss</span>Copyright &copy;2026 ECORIDE.</p> 

    </footer>
    <script src="../JS/navbarOnScroll.js"></script>


    <script src="/JS/passwordSecurity.js"></script>
    <script src="../JS/toggleResearch.js"></script>
</body>