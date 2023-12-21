<?php ob_start();
?>

<div class="bikes_details mt-5">
    <h3 class="bikes__title text-center mb-5">Vélo <?= $bike->bike_id ?></h3>
    <div class="card mx-auto" style="width: 18rem;">
        <img class="card-img-top" src="<?= $bike->photo?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Registration number : <?= $bike->registration_number?></h5>
            <p class="card-text"><?= $bike->description ?></p>
            <!-- <?php if(isset($_SESSION["user_id"])) { ?>
                <form action="?path=reservations.create" method="post">
                    <button type="submit">Réserver</button>
                </form>
                <?php } else { 
                    echo "Désolé, tu dois être connecté pour réserver.";
                }?> -->
            <a href="index.php">Retour</a>
        </div>
    </div>
</div>
<div class="reservation-form">
    
    <!-- <label for="selected_bike">Choisissez un vélo :</label> -->
    <!-- <select id="selected_bike" name="selected_bike" required>
        <option value="" disabled selected>Sélectionnez un vélo</option>
        <?php foreach ($reservations as $reservation) { ?>
            <option value="<?= $reservation->bike_id ?>"><?= $reservation ?></option>
            <?php } ?>
        </select> -->
        <?php if(isset($_SESSION["user_id"]) && $bike->availability===1) { ?>
            <h2>Réserver un vélo</h2>
            <form action="?path=reservations.create" method="post">
                <input type="hidden" name="bike_id" value="<?= $bike->bike_id ?>">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                <label for="start_date">Date de début :</label>
                <input type="date" id="start_date" name="start_date" required>
        
                <label for="end_date">Date de fin :</label>
                <input type="date" id="end_date" name="end_date" required>
                    <button type="submit">Réserver</button>
                <?php } elseif(!isset($_SESSION["user_id"])) { ?>
                    <p>Désolé, tu dois être connecté pour réserver.</p>
                <?php } else { ?>
                  
                    <p>DésoléLe vélo n'est plus disponible.</p>
                <?php }?>
    </form>
</div>

<?php $content = ob_get_clean()?>