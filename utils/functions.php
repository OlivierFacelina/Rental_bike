<?php
// notification

function showNotifications()
{
    // tester l'existance d'une clé notification dans la superglobale $_SESSION
    if (isset($_SESSION['notification'])) {
        // On parcours les notification qui sont stockée sous la forme clé/valeur ou la clé = type et valeur = message
        foreach ($_SESSION['notification'] as $key => $value) { ?>
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="liveToast" class="toast bg-<?= $key ?>" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body">
                        <?= $value ?>
                    </div>
                </div>
            </div>
<?php }
        // On vide le contenu de la session
        $_SESSION['notification'] = [];
        // on supprime la session
        unset($_SESSION);
    }
}

function redirectToRoute($route)
{
    header('Location: index.php?path=' . $route);
    exit();
}