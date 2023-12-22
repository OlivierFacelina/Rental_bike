<?php ob_start();
?>
<div>
    <nav class="navigation d-flex justify-content-between py-4">
        <button class="navigation__left btn btn-success">
            <a href="?path=users.dashboard">
                Gestion des utilisateur
            </a>
        </button>
        <h1 class="navigation__center">Ajout d'un utilisateur</h1>
        <div class="navigation__right" id="">
            <button class="btn btn-success">ID : <?= 'XXXXXXX' ?></button>
            <button class="btn btn-outline-danger" type="submit">Déconnexion</button>
        </div>
    </nav>
    <div class="d-flex justify-content-center">
        <form action="" method="post" class="col-4">
            <div class="mb-3">
                <label for="role_id" class="form-label">Roles</label>
                <select class="form-select" name="role_id" id="role_id" required>
                    <option value="1">Admin</option>
                    <option value="2" selected>Client</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Nom</label>
                <input class="form-control" type="text" name="lastname" id="lastname" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">Prénom</label>
                <input class="form-control" type="text" name="firstname" id="firstname" required>
            </div>
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input class="form-control" type="text" name="login" id="login" value="<?= $generateLogin ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>
            <button class="btn btn-success" type="submit">Confirmer</button>
        </form>
    </div>
</div>
<?php $content = ob_get_clean() ?>