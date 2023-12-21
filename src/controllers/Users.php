<?php

namespace App\Controllers;

use Exception;
use App\models\Users as UsersModel;

class Users extends BaseController
{

    public function index()
    {

        $usersModel = new UsersModel();

        // liste des étdutiants dans la bdd
        $bike = $usersModel->all();

        // Recherche
        try {
            // Tester l'existance d'une recherche
            if (!empty($_GET['search'])) {
                // On nettoie le texte soumis par l'utilisateur
                $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // Requête de récupération d'enrregistrements correspondant au texte de la recherche
                $result = $usersModel->all($search);

                // Si aucun résultat, on lève une exception
                if (empty($result)) {
                    throw new Exception('Aucun résultat');
                }
                // On remplace le contenu de la liste par le résulat de la recherche
                $students = $result;
            }
        } catch (Exception $ex) {
        }

        $title = 'Accueil';

        $this->render('student/index', compact('students', 'title'));
    }

    public function edit()
    {
        $student_id = $_GET['student_id'] ?? null;

        $student_id = filter_var($student_id, FILTER_VALIDATE_INT);

        if (is_null($student_id)) {
            header('Location: index.php');
            exit();
        }

        $student = null;
        $usersModel  = new UsersModel();

        try {
            $student = $usersModel->find($student_id);
        } catch (Exception $ex) {
            $_SESSION['notification']['danger'] = 'La mise à jour a échoué!';
            header('Location: index.php');
            exit();
        }

        // Vérifier qu'il existe une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = array_merge($_POST, $_GET);

            // var_dump($data);
            // Validation des données utilisateur
            $args = array(
                'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'birthdate' => array(
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => [
                        'regexp' => '/^\d{4}(-\d{2}){2}$/'
                    ]
                ),
                'email' => FILTER_VALIDATE_EMAIL,
                'phone' => array(
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => [
                        'regexp' => '/^0[67]+(-\d{2}){4}$/'
                    ]
                ),
                'address' => FILTER_SANITIZE_SPECIAL_CHARS,
                'student_id' => FILTER_VALIDATE_INT,
                'postal_code' => array(
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => [
                        'regexp' => '/^\d{5}$/'
                    ]
                ),
                'city' => FILTER_SANITIZE_SPECIAL_CHARS,
                'grade' => FILTER_SANITIZE_SPECIAL_CHARS
            );
            // la validation retourne la valeur si elle est correcte sinon elle renvoit NULL
            $validatedData = filter_var_array($data, $args);
            // var_dump($validatedData);
            // Explosion du tableau en variables
            extract($validatedData);

            try {
                if (is_null($email) || is_null($postal_code) | is_null($student_id)) {
                    throw new Exception("Le code de postal ou l'adresse email ou l'id est invalide");
                }

                // Mise à jour dans la bdd
                if ($usersModel->update($validatedData)) {
                    // Créer la notification a envoyé à l'utilisateur
                    $_SESSION['notification']['success'] = 'La mise à jour a bien été enregistrée!';
                    header('Location: index.php');
                    exit();
                }
            } catch (Exception $ex) {
                //throw $th;
            }
        }
        $title = 'Editer';

        $this->render('student/edit', compact('student', 'title'));
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

            password_hash($_POST["password"], PASSWORD_BCRYPT);
            
            $data = $_POST;
            // Validation des données utilisateur
            $args = array(
                'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'login' => FILTER_SANITIZE_SPECIAL_CHARS,
                'password' => FILTER_SANITIZE_SPECIAL_CHARS,
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
            if (!empty($_POST['student_id'])) {
                // On nettoie le texte soumis par l'utilisateur
                $student_id = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);
                // Requête de récupération d'enrregistrements correspondant au texte de la recherche
                // Si aucun résultat, on lève une exception
                if (is_null($student_id)) {
                    throw new Exception('L\'identifiant renseigné est incorrect!');
                }
                // On remplace le contenu de la liste par le résulat de la recherche
                if (!$usersModel->delete($student_id)) {
                    throw new Exception('La suppression a échouée !');
                } else {
                    $_SESSION['notification']['success'] = 'L\'étudient  a  bien été supprimé!';
                    redirectToRoute('/');
                }
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }
}
