<?php ob_start()?>

<div class="bikes_details mt-5">
    <h3 class="bikes__title text-center mb-5">Vélo <?= $bike->bike_id ?></h3>
    <div class="card mx-auto" style="width: 18rem;">
        <img class="card-img-top" src="<?= $bike->photo?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Registration number : <?= $bike->registration_number?></h5>
            <p class="card-text"><?= $bike->description ?></p>
            <?php if(isset($_SESSION["user_id"])) { ?>
                <form action="" method="post">
                    <button type="submit">Réserver</button> 
                </form>
                <?php } else { 
                    echo "Désolé, tu dois être connecté pour réserver.";
                }?>
            <a href="index.php">Retour</a>
        </div>
    </div>
</div>

<?php $content = ob_get_clean()?>