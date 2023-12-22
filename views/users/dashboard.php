<?php ob_start()?>
<section class="dashboard">
    <h4 class="dashboard__title text-center">Bienvenue sur votre tableau de bord, <?= $user_connected_info->firstname . ' ' . $user_connected_info->lastname ?></h4>    
    <div class="dashboard__head">
        <div class="row d-flex justify-content-center px-5 text-center align-content-center">
            <div class="add-user col-2"><a href="?path=users.create">Ajouter un utilisateur</a></div>
            <div class="index-reservation col-3"><a href="?path=reservations.index">Gestion des reservations</a></div>
            <div class="login col-1"><h6>Login : <?= $user_connected_info-> login ?></h6></div>
            <div class="col-3 "><a class="btn btn-outline-danger" href="?path=home">Deconnexion</a></div>
        </div>
    </div>

    <table class="table table-stripped text-center w-75 mx-auto">
        <thead>
            <td>Nom - Prénom</td>
            <td>Modifier </td>
            <td>Supprrimer</td>
        </thead>
        <tbody>
        <?php foreach ($all_user as $user) :  ?>
            <tr>
                <td><?= ucfirst($user->lastname)?> <?= ucfirst($user->firstname)?> </td>
                <td><a href="?path=users.edit&user_id=<?= $user->user_id?>" class="btn btn-success ">Modifier</a></td>
                <td>
                <form action="?path=users.delete" method="post" id="form_<?= $user->user_id?>">
                        <input type="hidden" name="user_id" value="<?= $user->user_id?>">
                    <button type="button" data-id="<?=  $user->user_id ?>" class="btn btn-danger btn_delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Supprimer</button>              
                </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</section>


<?php  $content = ob_get_clean()?>
        