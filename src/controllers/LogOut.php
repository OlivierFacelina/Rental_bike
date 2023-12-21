<?php 
namespace App\Controllers;
// session_start();
class LogOut extends BaseController{

    public function LogOut(){

        session_unset();
        session_destroy();
        
        // redirectToRoute('/');
        $title = 'HomePage';
        $this->render('home',compact('title'));
    }
}
// Détruire toutes les données de session






?>