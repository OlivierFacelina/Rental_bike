<!doctype html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/styles/css/style.css">

</head>

<body>
    <header class="container">
        <nav class="navigation d-flex justify-content-between py-4">
            <div class="navigation__left">
                <a href=""><img src="" alt="" srcset="">logo</a>
            </div>
            <div class="navigation__center">
                <a href="http://" target="_blank" rel="noopener noreferrer">Home</a>
                <a href="http://" target="_blank" rel="noopener noreferrer">Nos vélos</a>
                <a href="http://" target="_blank" rel="noopener noreferrer"> A propos </a>
            </div>
            <div class="navigation__right">
                <button type="button"><a href="?path=reservation.index">Réservation</a></button>
                <button type="button"><a href="?path=users.index">Connexion</a></button>
            </div>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>
    <footer>
        <div class="rectangle-37">
            <div class="frame-20">
                <!-- <img class="frame-20___1485-d-977-3609-4158-805-a-f-77401-a-39-e-13-removebg-preview-2" src="_1485-d-977-3609-4158-805-a-f-77401-a-39-e-13-removebg-preview-20.png" /> -->
                <div class="frame-20__frame-18">
                    <div class="frame-20__navigation">Navigation</div>
                    <div class="frame-20__home">Home</div>
                    <div class="frame-20__nos-v-los">Nos vélos</div>
                    <div class="frame-20__about-us">About us</div>
                </div>
                <div class="frame-20__frame-19">
                    <div class="frame-20__horraires">Horraires</div>
                    <div class="frame-20__en-semaine-de-8-h-20-h">En semaine de 8h à 20h</div>
                    <div class="frame-20__confidentialit">Confidentialité</div>
                    <div class="frame-20__cgu">CGU</div>
                    <div class="frame-20__politique-de-confidentialit">
                        Politique de confidentialité
                    </div>
                </div>
            </div>


        </div>


    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./assets/js/app.js"></script> --
</body>

</html>