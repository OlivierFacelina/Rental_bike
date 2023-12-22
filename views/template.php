<?php 
// session_start() 
?>

<!doctype html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/styles/css/style.css">

</head>

<body>
    <main>
        <header class="container header">
                <nav class="navigation">
                        <div class="navigation__left">
                            <a href=""><img src="./assets/img/logo.png" class="" alt="" srcset=""></a>
                        </div>
                        <div class="navigation__center">
                            <a href="?path=/"  rel="noopener noreferrer">Home</a>
                            <a href="?path=bikes.index"  rel="noopener noreferrer">Nos vélos</a>
                            <?php if (isset($_SESSION['user_id'])) { ?> 
                                <a href="?path=users.dashboard">Tableau de bord</a>
                            <?php } ?> 
                            <!-- <a href=""  rel="noopener noreferrer">Réserver</a> -->
                            <a href=""  rel="noopener noreferrer"> A propos </a>
                        </div>
                        <div class="navigation__right">
                            <button type="button" class="btn_secondary"><a href="?path=users.details">Mes réservations</a></button>
                            <?php if (isset($_SESSION['user_id'])) { ?>
                            <button type="button" class="btn_primary"><a href="?path=deconnection">Déconnexion</a></button>
                            <?php } else {?>
                                <button type="button" class="btn_primary"><a href="?path=users.index">Connexion</a></button>
                            <?php }?>
                        </div>
                </nav>
        </header>
        <?= $content ?>
    </main>
    
    <footer>
        <div class="footer columns_footer">
            <div class="footer__logo">
                <div class="logo_footer">
                    <img src="./assets/img/logo.png" alt="logo" srcset="">
                </div>
            </div>
            <div class="footer__link">
                <a href="?path=/">Home</a>
                <a href="?path=reservations.index">Reservation</a>
                <a href="?path=bikes.index">Nos vélos</a>
                <a href="#">About us</a>
            </div>
            <div class="footer__hours">
                <div class="hours-column">
                    <h6>Horaires</h6>
                    <p>En semaine de 8h à 20h</p>
                </div>
                <div class="hours-column">
                    <h6>Confidentialité</h6>
                    <p>Politique de Confidentialité</p>
                    <p>CGU</p>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>© La Manu 2023 - Tous droits réservés</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./assets/js/app.js"></script>
</body>

</html>