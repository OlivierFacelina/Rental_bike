<?php 
ob_start()?>
<h3> Pages admin/employés </h3>
<h4> Authentification</h4>



<form action="" method="post">
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="identiiant" class="form-label">Identifiant</label>
            <input type="text" class="form-control" id="identiiant" aria-describedby="emailHelp" name="login">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name ="password" >
        </div>
        
    </div>
    <div class="col-md-4 mt-4">
        <button type="submit" class="btn btn-primary">Connexion</button>
    </div>








    <!-- <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> -->

</form>
<?php  $content = ob_get_clean()?>