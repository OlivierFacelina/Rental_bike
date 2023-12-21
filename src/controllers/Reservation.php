<?php

namespace App\Controllers;

use Exception;
use App\models\Reservation as ReservationModel;

class Reservation extends BaseController
{

    public function index()
    {
        $reservationModel = new ReservationModel();
        $reservations = $reservationModel->all();

        if (isset($_POST['status']) && isset($_POST['res_num'])) {
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $res_num = filter_input(INPUT_POST, 'res_num', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $reservationModel->update($status, $res_num);
            redirectToRoute('reservations.index');
        }

        try {
            if (!empty($_POST['search'])) {

                $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $result = $reservationModel->all($search);
                if (empty($result)) {
                    throw new Exception('Aucun résultat');
                }
                $reservations = $result;
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        }

        $title = 'Gestion des réservations';

        $this->render('reservations/index', compact('title', 'reservations'));
    }

    public function create()
    {
        $reservationModel  = new ReservationModel();

        $reservations = $reservationModel->all();

        $user_id = $_SESSION["user_id"];
        $bike_id = $_POST["bike_id"] ?? 0;
        $res_num = 0;
        $start_date = '';
        $end_date = '';
        var_dump($_POST);
        // Vérifier qu'il existe une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = $_POST;
            // var_dump($_POST);
            // Validation des données utilisateur
            $args = array(
                'user_id' => FILTER_SANITIZE_NUMBER_INT,
                'bike_id' => FILTER_SANITIZE_NUMBER_INT,
                'registration_number' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'start_date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'end_date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            // la validation retourne la valeur si elle est correcte sinon elle renvoit NULL
            $validatedData = filter_var_array($data, $args);

            unset($validatedData['registration_number']);
            var_dump($validatedData);
            // Explosion du tableau en variables
            extract($validatedData);

            // // on rétire la clé student_id
            // unset($validatedData['student_id']);
            // // var_dump($validatedData);

            try {
                // Mise à jour dans la bdd
                if ($reservationModel->create($validatedData)) {
                    // Créer la notification a envoyé à l'utilisateur
                    // $_SESSION['notification']['success'] = 'L\'étudient  a  bien été enregistré!';
                    // header('Location: index.php');
                    // redirectToRoute('/');
                    var_dump("Tout fonctionne");

                    // exit();
                }
            } catch (Exception $ex) {
                var_dump($ex);
            }
        }
        $title = 'Ajouter un vélo';
        $this->render('home', compact('title', 'reservations'));
    }

    public function delete()
    {
        $reservationModel = new ReservationModel();
    
        try {
            // Vérifier l'existence de res_num dans la requête POST
            if (isset($_POST['res_num'])) {
                var_dump('zgzHZ');
                // Nettoyer et valider l'identifiant de réservation
                $res_num = filter_input(INPUT_POST, 'res_num', FILTER_VALIDATE_INT);
    
                // Si $res_num est null, l'identifiant renseigné est incorrect
                if (is_null($res_num)) {
                    throw new Exception('L\'identifiant renseigné est incorrect!');
                }
    
                // Supprimer la réservation
                if ($reservationModel->delete($res_num)) {
                    $_SESSION['notification']['success'] = 'La réservation a bien été supprimée!';
                } else {
                    $_SESSION['notification']['danger'] = 'La suppression de la réservation a échoué!';
                }
    
                // Redirection vers la liste des réservations
                redirectToRoute('reservations.index');
            }
        } catch (Exception $ex) {
            // Gérer l'exception ici (afficher un message d'erreur, etc.)
            var_dump($ex);
        }
    }
    
}
