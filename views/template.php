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
                            <a href=""><img src="" alt="" srcset="">logo</a>
                        </div>
                        <div class="navigation__center">
                            <a href="?path=/"  rel="noopener noreferrer">Home</a>
                            <a href="?path=bikes.index"  rel="noopener noreferrer">Nos vélos</a>
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
        <div class="columns_footer">
                <div class="footer__left">
                    <div class="logo_footer">
                        <img src="" alt="logo" srcset="">
                    </div>
                </div>
                <div class="footer__center">
                    
                    <h6> Navigation</h6>
                    <p>Home</p>
                    <p>Reservation</p>
                    <p>Nos vélos</p>
                    <p>About us</p>
                </div>
                <div class="footer__right">
                <h6> Horraires</h6>
                    <p>En semaine de 8h à 20h</p>
                    <h6>Confidentialité</h6>
                    <p> <p>Politique de Confidentialité</p></p>
                    <p>CGU</p>
                </div>
        </div>
        <!-- <div class="copyright">
            <p>© 2021 - Tous droits réservés</p>
        </div> -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./assets/js/app.js"></script> --
</body>

</html>