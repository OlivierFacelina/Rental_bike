<?php ob_start()?>

<div class="container mt-5 mb-5">
    <form class="mx-auto">
        <div class="form-group">
        <label for="registration">Numéro d'immatriculation</label>
        <input type="text" class="form-control w-25" id="registration" name="registration" placeholder="Saisissez le numéro d'immatriculation">
        </div>
        <div class="form-group mt-3">
        <label for="availability">Disponibilité (saisissez 0 pour non disponible, saisissez 1 pour disponible)</label>
        <input type="text" class="form-control w-25" id="availability" name="availability" placeholder="Renseignez son état">
        </div>
        <div class="form-group mt-3">
        <label for="description">Description</label>
            <textarea class="form-control w-25" name="description" id="description" rows="3"></textarea>
        </div>
        <div class="form-group mt-3">
        <label for="photo">Image</label>
        <input type="file" class="form-control w-25" id="photo" name="photo" placeholder="Choisissez une image">
        <input type="submit" class="mt-3" value="Envoyer">
        </div>
    </form>
</div>

<?php $content = ob_get_clean()?>
