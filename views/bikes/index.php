<?php ob_start()?>
<div class="bikes mt-5">
    <h3 class="bikes__title text-center">Découvrez nos vélos</h3>
    <?php $counter = 0; ?>
    <div class="bikes__card mt-5 d-flex justify-content-center">
        <?php foreach ($bikes as $bike) { ?>
            <?php if ($counter % 3 === 0 && $counter !== 0) { ?>
                </div><div class="bikes__card mt-5 d-flex justify-content-center">
            <?php } ?>
            <div class="card mx-3" style="width: 18rem;">
                <img class="card-img-top" src="<?= $bike->photo?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Registration number : <?= $bike->registration_number?></h5>
                    <p class="card-text"><?= $bike->description ?></p>
                    <a href="?path=bikes.details&bike_id=<?= $bike->bike_id ?>">Détails</a>
                </div>
            </div>
            <?php $counter++; ?>
        <?php } ?>
    </div>
</div>
<?php $content = ob_get_clean()?>
