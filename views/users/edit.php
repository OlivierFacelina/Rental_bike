<?php ob_start()?>

<h6 class="text-center"> Modification de l'utilisateur : <?= $user_details -> lastname?> <?= $user_details -> firstname?> </h6>
<form action="" method="post" class="container">
    <div class="row ">
        <div class="mb-3 col-md">
            <label for="exampleFormControlInput1" class="form-label">Nom</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $user_details -> lastname ?>" name="lastname">
        </div>
        <div class="mb-3 col-md">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="firstname" value="<?= $user_details -> firstname ?>" name="firstname">
        </div> 
        <div class="mb-3 col-md">
            <label for="firstname" class="form-label">Login</label>
            <input type="text" class="form-control" id="firstname" value="<?= $user_details -> login ?>" name="login">
        </div>
    </div>
    <button type="submit" class="btn btn-outline-light d-flex justify-content-center mx-auto my-2">Modifier</button>
</form>
<?php  $content = ob_get_clean()?>
