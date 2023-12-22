<?php ob_start();
?>
<div>
    <nav class="navigation d-flex justify-content-between py-4">
        <button class="navigation__left btn btn-success">
            <a href="?path=reservations.index">
                Gestion des réservations
            </a>
        </button>
        <h1 class="navigation__center">Enregistrement des vélos</h1>
        <div class="navigation__right" id="">
            <button class="btn btn-success">ID : <?= 'XXXXXXX' ?></button>
            <button class="btn btn-outline-danger" type="submit">Déconnexion</button>
        </div>
    </nav>
    <div class="d-flex justify-content-center">
        <form action="" method="post" class="col-4">
            <div class="mb-3">
                <label for="registration_number" class="form-label">Immatriculation</label>
                <input class="form-control" type="text" name="registration_number" id="registration_number" value="<?= $generateRegistration ?>" required>
            </div>
            <div class="mb-3">
                <label for="availability" class="form-label">Disponible</label>
                <select class="form-select" name="availability" id="availability" required>
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Image</label>
                <input class="form-control" type="file" name="photo" id="photo" required>
            </div>
            <!-- <div class="mb-3">
                <label for="firstname" class="form-label">Prénom</label>
                <input class="form-control" type="text" name="firstname" id="firstname" required>
            </div> -->
            <button class="btn btn-success" type="submit">Confirmer</button>
        </form>
    </div>
</div>
<?php 
$content = ob_get_clean();
