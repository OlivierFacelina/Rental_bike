<?php ob_start()?>
<section id="dashboard">

    <h4 class="text-center my-4">Dashboard</h4>    
    <h5 class="text-center my-4">Gestions des utilisateurs </h5>  
    <h3>Bonjour <?= $user_connected_info-> lastname . ' '.$user_connected_info -> firstname ?>,</h3>  
    <div class="dashboard_head">
        <div class="row d-flex justify-content-center px-5 text-center align-content-cneter">
            <div class="col-2 bg-success"><a href="?path=users.create">Ajouetr un utilisateur</a></div>
            <div class="col-3"><a href="?path=reservations.index">Gestion des reservations</a></div>
            <div class="col-1 bg-success"><h6>Login : <?= $user_connected_info-> login ?></h6></div>
            <div class="col-3 ">  <a class="btn btn-outline-danger" href="?path=home">Deconnexion</a></div>
        </div>
    </div>

    <table class="table table-stripped text-center w-75 mx-auto">
        <thead>
            <td>Nom - Prénom</td>
            <td> Modifier </td>
            <td> supprrimer</td>
        </thead>
        <tbody>
        <?php foreach ($all_user as $user) :  ?>
            <tr>
                <td><?= ucfirst($user->lastname)?> <?= ucfirst($user->firstname)?> </td>
                <td><a href="?path=users.edit&user_id=<?= $user->user_id?>" class="btn btn-success "> Modifier</a></td>
                <td>
                <form action="?path=users.delete" method="post" id="form_<?= $user->user_id?>">
                        <input type="hidden" name="user_id" value="<?= $user->user_id?>">
                    <button type="button" data-id="<?=  $user->user_id ?>" class="btn btn-danger btn_delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop">supprimer</button>              
                </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <ul>
        <!-- <?php foreach ($all_user as $user) :  ?>
            <li>
                <h5 class="h5" ><?= ucfirst($user->lastname)?> <?= ucfirst($user->firstname)?>   </h5>
                <a href="?path=users.edit&user_id=<?= $user->user_id?>" class="btn btn-success "> Modifier</a>
                <form action="?path=users.delete" method="post" id="form_<?= $user->user_id?>">
                        <input type="hidden" name="user_id" value="<?= $user->user_id?>">
                    <button type="button" data-id="<?=  $user->user_id ?>" class="btn btn-danger btn_delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-trash"></i></button>              
                </form>
            </li>
        <?php endforeach; ?> -->
        <?php require __DIR__ . '/../_delete-modal.php' ?>

    </ul>
</section>


<?php  $content = ob_get_clean()?>
        