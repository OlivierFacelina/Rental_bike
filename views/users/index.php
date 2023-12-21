<?php 
ob_start()?>
<!-- <h3> Pages admin/employés </h3> -->
<secion id="login">
    <h4 class="text-center"> Connectez-vous</h4>
    <div class="login_form">
        <form action="" method="post">
            <div class="row">
                <div class="mb-3">
                    <label for="identiiant" class="form-label">Identifiant</label>
                    <input type="text" class="form-control" id="identiiant" aria-describedby="emailHelp" name="login">
                    <div id="emailHelp" class="form-text">Votre identiiant ne sera pas partagé</div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name ="password" >
                </div>
                
            </div>
            <div class="row mt-4 w-25 mx-auto">
                <button  type="submit" class="login_btn">Connexion</button>
            </div>
        </form>
    </div>
</secion>
<?php  $content = ob_get_clean()?>