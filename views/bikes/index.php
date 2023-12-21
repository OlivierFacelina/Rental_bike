<?php ob_start()?>
<div class="bikes mt-5">
    <div class="title d-flex justify-content-center">
        <h3 class="bikes__title text-center mx-5">Découvrez nos vélos</h3>
    </div>
    <?php $counter = 0; ?>
    <div class="bikes__card mt-5 d-flex justify-content-center">
        <?php foreach ($bikes as $bike) { ?>
            <?php if ($counter % 3 === 0 && $counter !== 0) { ?>
                </div><div class="bikes__card mt-5 d-flex justify-content-center">
            <?php } ?>
            <div class="card mx-4" style="width: 24rem;">
                <img class="card-img-top" src="./assets/img/<?= $bike->photo ?>" alt="Card image cap" height="300px" width="300px">
                <div class="card-body">
                    <h5 class="card-title my-2">Registration number : <?= $bike->registration_number?></h5>
                    <p class="card-text "><?= $bike->description ?></p>
                    <a class="btn btn-success px-3 my-1" href="?path=bikes.details&bike_id=<?= $bike->bike_id ?>">Détails</a>
                    <p class="mt-3">
                        Disponibilité : 
                        <b>

                        <?php if($bike->availability == 0) { 
                            echo "Non disponible";
                            }
                            else if($bike->availability == 1) {
                                echo "Disponible"; }?>
                        </b>
                    </p>
                </div>
            </div>
            <?php $counter++; ?>
        <?php } ?>
    </div>

</div>
<?php $content = ob_get_clean()?>
