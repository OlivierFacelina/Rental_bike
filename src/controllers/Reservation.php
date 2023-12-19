<?php

namespace App\Controllers;
use Exception;
use App\models\Reservation as ReservationModel;
class Reservation extends BaseController {

public function index()
{

    $reservationModel = new ReservationModel();
    
    $students = $reservationModel->all();

    try {

        if (!empty($_GET['search'])) {

            $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $result = $reservationModel->all($search);

            if (empty($result)) {
                throw new Exception('Aucun résultat');
            }

            $students = $result;
        }
    } catch (Exception $ex) {
    }

    $title = 'Gestion des réservations';

    $this->render('reservations/index', compact('reservations', 'title'));
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
    $reservationModel = new ReservationModel();

    try {
        $student = $reservationModel->find($student_id);
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
            if ($student_model->update($validatedData)) {
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
    $reservationModel = new ReservationModel();

    $firstname = '';
    $lastname = '';
    $birthdate = '';
    $email = '';
    $phone = '';
    $address = '';
    $postal_code = '';
    $city = '';
    $grade = '';
    try {
        // $student = get_student_by_id($db);
    } catch (Exception $ex) {
        $_SESSION['notification']['danger'] = 'La mise à jour a échoué!';
        header('Location: index.php');
        exit();
    }

    // Vérifier qu'il existe une requête POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $data = $_POST;
        var_dump($data);
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

        // on rétire la clé student_id
        unset($validatedData['student_id']);
        var_dump($validatedData);

        try {
            if (is_null($email) || is_null($postal_code)) {
                throw new Exception("Le code de postal ou l'adresse email ou l'id est invalide");
            }

            // Mise à jour dans la bdd
            if ($reservationModel->create($validatedData)) {
                // Créer la notification a envoyé à l'utilisateur
                $_SESSION['notification']['success'] = 'L\'étudient  a  bien été enregistré!';
                header('Location: index.php');
                exit();
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }
        $title = 'Ajouter un étudiant';
        $this->render('student/create', compact('title'));
    }
}

public function delete()
{
    $reservationModel = new ReservationModel();
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
            if (!$reservationModel->delete($student_id)) {
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