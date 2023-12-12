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
    <link rel="stylesheet" href="/assets/styles/css/style.css">
</head>

<body>
    <main>
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
                    <button type="button">Réservation</button>
                    <button type="button">connexion</button>
                </div>
            </nav>
        </header>
        <section class="banner">
            <div class="banner_text ">
                <h4> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae consequuntur amet accusamus inventore fugit.</h4>
                <p>Lorem ipsum dolor, sit amet consectetur</p>
                <button> Réserver</button>
            </div>
            <div class="banner_img">
                <img src="./assets/img/7732616_5243.svg" alt="" width="700px">
            </div>
        </section>
        <section class="gallery_slide">
            <h2 class="text-center">Derniers modèles</h2>
            <!-- 
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="./assets/img/velo1.jpg" alt="">
                        </div>
                    <div class="swiper-slide">
            -->
        </section>
        <?= $content ?>
    </main>
    <footer>
        <!-- <img class="element" src="img/1485d977-3609-4158-805a-f77401a39e13-removebg-preview-2.png" />  -->
        <div class="div">
            <div class="text-wrapper">Navigation</div>
            <div class="text-wrapper-2">Home</div>
            <div class="text-wrapper-2">Nos vélos</div>
            <div class="text-wrapper-2">About us</div>
        </div>
        <div class="div-2">
            <div class="text-wrapper">Horaires</div>
            <p class="p">En semaine de 7h à 22h</p>
            <div class="text-wrapper-3">Confidentialité</div>
            <div class="text-wrapper-4">CGU</div>
            <div class="text-wrapper-5">Politique de confidentialité</div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./assets/js/app.js"></script>
</body>

</html>

