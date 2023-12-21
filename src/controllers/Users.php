<?php

namespace App\Controllers;

use Exception;
use App\models\Users as UsersModel;

class Users extends BaseController
{

    public function index()
    {

    $usersModel = new UsersModel();
    
    // fonction pour crypter le smots de passe 
    // $password = $usersModel->updatePassword();
    // var_dump($password);
    // Recherche

    // isset($_POST["login"]) && !empty($_POST["login"])
    //recupération des données du champs d'authentification
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        if (isset($_POST) && !empty($_POST)) {
            var_dump($_POST);
            $login = filter_input(INPUT_POST,"login",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$login) {
                var_dump('il n\'y pas de chiffrre dans cette vaiable');
                $errors ["login"] = 'il n\'y pas de chiffrre dans cette vaiable';
            }
            $password = $_POST["password"];
            // $password_hashed = password_hash($password, PASSWORD_BCRYPT);
            var_dump($password);
            //appell de la fonction d'authetification
            $userAuth = $usersModel -> authUser($login);
            if (password_verify($password , $userAuth -> password)) {
                var_dump("mot de passe correct");
                $_SESSION['user_id'] = $userAuth->user_id;
                $_SESSION['user_role'] = $userAuth->role_id;
                $user_role = $userAuth -> role_id;
                // var_dump($user_role);
                // var_dump($_SESSION);
                // die();
                    if ($user_role == 2 ) {
                        redirectToRoute('/');
                    } else {
                        redirectToRoute('users.dashboard');
                    }
                    
            } else {
                var_dump("mot de passe incorrect");
            }
          
            // var_dump($userAuth);
            // var_dump($userAuth -> password);
        }
    }




    $title = 'Authentification';

    $this->render('users/index', compact( 'title'));
}
public function all(){
    $usersModel = new UsersModel();
    //fonction pour avoir tout les utilisatuers dans le dshboard
    if(isset($_SESSION)&& !empty($_SESSION)){
        $user_id = $_SESSION["user_id"];
        // var_dump($user_id);
        $user_connected_info = $usersModel -> find_user($user_id);
        // var_dump($user_connected_info);
    }

    $all_user = $usersModel -> all_user();
    // var_dump($all_user);

    $title = 'Dashboard';

    $this->render('users/dashboard', compact( 'title','all_user','user_connected_info'));
}

public function edit()
{
    $usersModel  = new UsersModel();
    $user_id = $_GET['user_id'] ?? null;
    var_dump($user_id);
    $user_id = filter_var($user_id, FILTER_VALIDATE_INT);

    // if (is_null($user_id)) {
    //     redirectToRoute('/');
    //     exit();
    // }

    // $user = null;
    // $user_details = $usersModel -> find($user_id);
    // var_dump($user_details);

    try {
        $user_details = $usersModel -> find_user($user_id);
    } catch (Exception $ex) {
        // $_SESSION['notification']['danger'] = 'La mise à jour a échoué!';
        redirectToRoute('/');

    }

    // // Vérifier qu'il existe une requête POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        var_dump($_POST);
        //extrction des données 
        $firstname = filter_input(INPUT_POST,"firstname",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST,"lastname",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $login = filter_input(INPUT_POST,"login",FILTER_VALIDATE_INT);
        //Vérifions si l'utilisateur a bien modifié au moins un champ
        
        var_dump($firstname,$lastname,$login);
            if (!empty($firstname) && !empty($lastname) && (!empty($login)) && preg_match('/^\d{4}$/', $login)) {
               var_dump("tout fonctionne ");
               $usersModel -> edit($firstname,$lastname,$login,$user_id);
                redirectToRoute('users.dashboard');

                       //         // Créer la notification a envoyé à l'utilisateur
        //         // $_SESSION['notification']['success'] = 'La mise à jour a bien été enregistrée!';
        //         // header('Location: index.php');
        //         // exit();
        //     }
               
            }
            else {
                var_dump("ça marche pas ");
            }
    }
    $title = 'Editer';

        $this->render('users/edit', compact('user_details', 'title'));
    }

    public function create()
    {
        $usersModel  = new UsersModel();

        $firstname = '';
        $lastname = '';
        $login = '';
        $password = '';
        $role_id = '';
        // try {
        //     $user = get_user_by_id($db);
        // } catch (Exception $ex) {
        //     $_SESSION['notification']['danger'] = 'La mise à jour a échoué!';
        //     header('Location: index.php');
        //     exit();
        // }
        function randomGeneratedNumber()
        {
            // Générer un nombre aléatoire entre 0 et 9999
            $randomNumber = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

            return $randomNumber;
        }

        function generateUniqueLogin()
        {
            $usermodel = new UsersModel();
            
            // Déclarer la variable $newLogin avant de l'utiliser
            $newLogin = randomGeneratedNumber();
            
            // Vérifier si le login est déjà utilisé
            $uselogin = $usermodel->AlreadyUseLogin($newLogin);

            // Si le login est déjà utilisé, générer un nouveau login unique
            while ($uselogin) {
                $newLogin = randomGeneratedNumber();
                $uselogin = $usermodel->AlreadyUseLogin($newLogin);
            }

            return $newLogin;
        }


        // Vérifier qu'il existe une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $_POST['password'] = $password;
            $data = $_POST;
            // Validation des données utilisateur
            $args = array(
                'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'login' => FILTER_SANITIZE_SPECIAL_CHARS,
                'password' => '',
                'role_id' => FILTER_SANITIZE_SPECIAL_CHARS,
            );
            // la validation retourne la valeur si elle est correcte sinon elle renvoit NULL
            $validatedData = filter_var_array($data, $args);

            // var_dump($validatedData);
            // Explosion du tableau en variables
            extract($validatedData);

            // on rétire la clé student_id
            // unset($validatedData['student_id']);

            try {
                // Mise à jour dans la bdd
                if ($usersModel->create($validatedData)) {
                    // Créer la notification a envoyé à l'utilisateur
                    $_SESSION['notification']['success'] = 'L\'utilisateur  a  bien été enregistré!';

                    redirectToRoute('users.create');
                    exit();
                }
            } catch (Exception $ex) {
                var_dump($ex);
            }
        }
        $generateLogin = generateUniqueLogin();
        $title = 'Ajouter un utilisateur';
        $this->render('users/create', compact('title', 'generateLogin'));
    }

    public function delete()
    {
        $usersModel  = new UsersModel();
        // Suppression d'un étudiant | à faire avant l'affichage de liste pour que les données afficher soit à jour par rapport au contenu de la BDD
        try {
            // Tester l'existance d'une recherche
            if (!empty($_POST['user_id'])) {
                // On nettoie le texte soumis par l'utilisateur
                $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
                // Requête de récupération d'enrregistrements correspondant au texte de la recherche
                // Si aucun résultat, on lève une exception
                if (is_null($user_id)) {
                    throw new Exception('L\'identifiant renseigné est incorrect!');
                }
                // On remplace le contenu de la liste par le résulat de la recherche
                if (!$usersModel ->delete($user_id)) {
                    throw new Exception('La suppression a échouée !');
                } 
                else {
                    // $_SESSION['notification']['success'] = 'L\'étudient  a  bien été supprimé!';
                    redirectToRoute('/');
                }
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }
    public function find(){
    $usersModel  = new UsersModel();
    if(isset($_SESSION)&& !empty($_SESSION)){
        $user_id = $_SESSION["user_id"] ?? '';
        $details_reservations = $usersModel -> find($user_id);
        // var_dump($details_reservations);
        $title = 'Mes réservations';
        $this->render('users/details', compact( 'title','details_reservations'));
    }
    else{
        $title = 'Mes réservations';
        $this->render('users/details', compact( 'title'));
    }
    


    }
}

