<?php ob_start()?>
<?php if (isset($_SESSION['user_id'])) { ?>
    <div class="show_reservation">
        <h2 class="text-center">Bonjour <?= $details_reservations[0] -> lastname . ' ' . $details_reservations[0] -> firstname?></h2>
            <h5 class="text-center"> Bienvenue sur Votre page de reservation de Vélos </h5>
            <?php foreach ($details_reservations as $reservation): ?>
            <div class="reservation">
                <div class="bike_img">
                    <img src="./assets/img/<?= $reservation -> photo ?>" alt="image vélo" srcset="">
                </div>
                <div class="bikereservation_desc">
                    <p><b>Numéro du vélo :</b>  <?= $reservation -> registration_number ?></p>
                    <p><b>Numéro de reservation :</b> <?= $reservation -> res_num ?></p>
                    <p><b>Date de reservation :</b> <?= $reservation -> res_date ?></p>
                    <p><b>Début de reservation :</b> <?= $reservation -> start_date ?></p>
                    <p><b>Fin de reservation :</b> <?= $reservation -> end_date ?></p>
                    <p><b>Statut de la reservation :</b> <?= $reservation -> end_date ?></p>
                </div>
            </div>
            <?php endforeach; ?>
    </div>
<?php } else {?>
    <h1> Pour voir vos réservations vous devez vous connecter</h1>
<a href="?path=users.index" class="btn btn-success">Se connecter</a>
<?php }?>

<?php
$content = ob_get_clean() ?>