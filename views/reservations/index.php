<?php ob_start()?>
<h3></h3>
<div class="title d-flex justify-content-center mb-5">
    <h3 class="bikes__title text-center mx-5">Réservez votre vélo</h3>
</div>
<div class="reservation w-50 d-flex justify-content-center mx-auto">
    <form action="" method="post">
        <div class="d-flex">
            <div class="form-group mt-5 mb-5 mx-5">
                <label for="start_date" class="mb-2">Date début :</label>
                <input type="date" class="form-control w-100" id="start_date" name="start_date" placeholder="Saisissez le numéro d'immatriculation">
            </div>
            <div class="form-group mt-5 mb-5 mx-5">
                <label for="end_date" class="mb-2">Date de fin :</label>
                <input type="date" class="form-control w-100" id="end_date" name="end_date" placeholder="Saisissez le numéro d'immatriculation">
            </div>
        </div>
        <div class="form-group d-flex flex-column justify-content-center mx-5">
            <label for="velo" class="mb-2">Vélo : </label>
            <select name="bike_id" id="select" class="form-select">
            <option active value="">Sélectionner votre vélo</option>
            <?php foreach ($reservations as $reservation) { ?>
                <option value="<?= $reservation->bike_id ?>"><?= $reservation->bike_id?> - <?= $reservation->registration_number ?></option>
                <?php } ?>
            </select><br>
            <input type="submit" class="w-25 mx-auto mt-5 mb-5">
        </div>
    </form>
</div>
<?php $content = ob_get_clean()?>