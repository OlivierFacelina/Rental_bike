<?php ob_start()?>
<section id="dashboard">

    <h4 class="text-center my-4">Dashboard</h4>    
    <h4 class="text-center my-4">Clients (ou utilisateurs)</h4>  
    <h5>Bonjour : <?= $user_connected_info-> lastname . ' '.$user_connected_info -> firstname ?></h5>  
    <div class="dashboard_head">
        <div class="row d-flex justify-content-center px-5 text-center align-content-cneter">
            <div class="col-2 bg-success"><h6 >Ajouter un utilisateur </h6></div>
            <div class="col-3"><h5>Gestions des utilisateur</h5></div>
            <div class="col-1 bg-success"><h6>Login : <?= $user_connected_info-> login ?></h6></div>
            <div class="col-3 "> <h6 class="btn btn-outline-danger"> Deconnexion </h6></div>
        </div>
    </div>

    
    <ul>
        <?php foreach ($all_user as $user) :  ?>
            <li>
                <h5 class="h5" ><?= ucfirst($user->lastname)?> <?= ucfirst($user->firstname)?>   </h5>
                <a href="?path=users.edit&user_id=<?= $user->user_id?>" class="btn btn-success "> Modifier</a>
                <form action="?path=users.delete" method="post" id="form_<?= $user->user_id?>">
                        <input type="hidden" name="user_id" value="<?= $user->user_id?>">
                    <!-- <button type="button" href="" class="btn btn-danger my-3 btn_delete" data-id="<?= $user->user_id?>">supprrimer</button>   -->
                    <button type="button" data-id="<?=  $user->user_id ?>" class="btn btn-danger btn_delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-trash"></i></button>              
                </form>
            </li>
        <?php endforeach; ?>
        <?php require __DIR__ . '/../_delete-modal.php' ?>

    </ul>
</section>


<?php  $content = ob_get_clean()?>
        