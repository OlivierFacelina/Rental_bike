<div class="reservation-form">
    <h2>Réserver un vélo</h2>
    <form action="" method="post">
        <label for="start_date">Date de début :</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">Date de fin :</label>
        <input type="date" id="end_date" name="end_date" required>

        <label for="selected_bike">Choisissez un vélo :</label>
        <select id="selected_bike" name="selected_bike" required>
            <option value="" disabled selected>Sélectionnez un vélo</option>
            <?php foreach ($availableBikes as $bikeId => $bikeName) { ?>
                <option value="<?= $bikeId ?>"><?= $bikeName ?></option>
            <?php } ?>
        </select>

        <button type="submit" name="reserve_button">Réserver</button>
    </form>
</div>