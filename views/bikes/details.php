<?php ob_start()?>

<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="<?= $bike->photo?>" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Registration number : <?= $bike->registration_number?></h5>
        <p class="card-text"><?= $bike->description ?></p>
    </div>
</div>

<?php $content = ob_get_clean()?>
