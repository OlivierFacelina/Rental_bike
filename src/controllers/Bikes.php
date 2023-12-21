<?php

namespace App\Controllers;
use Exception;
use App\models\Bikes as BikesModel;
class Bikes extends BaseController {

public function index()
{

    $bikeModel = new BikesModel();
    
    // liste des étdutiants dans la bdd
    $bikes = $bikeModel->all();
    $title = 'Accueil';

    $this->render('bikes/index', compact('bikes', 'title'));
}

public function find()
{
    $bike_id = $_GET['bike_id'] ?? null;

    $bike_id = filter_var($bike_id, FILTER_VALIDATE_INT);

    if (is_null($bike_id)) {
        header('Location: index.php');
        exit();
    }

    $bike = null;
    $bikeModel  = new BikesModel();

    try {
        $bike = $bikeModel ->find($bike_id);
    } catch (Exception $ex) {
        $_SESSION['notification']['danger'] = 'La mise à jour a échoué!';
        header('Location: index.php');
        exit();
    }

    $title = 'Liste des détails';

    $this->render('bikes/details', compact('bike', 'title'));
}

public function create()
{
    $bikeModel  = new BikesModel();

    $registration_number = '';
    $photo = '';
    
    function randomGeneratedRegistration ($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
    }

    function generateUniqueRegistration()
    {
        $bikesmodel = new BikesModel();
        
        $newRegistraion = randomGeneratedRegistration();
        
        $useRegistration = $bikesmodel->AlreadyUseRegistration($newRegistraion);

        while ($useRegistration) {
            $newRegistraion = randomGeneratedRegistration();
            $useRegistration = $bikesmodel->AlreadyUseRegistration($newRegistraion);
        }

        return $newRegistraion;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        var_dump('gqgzrhzh3');
        $data = $_POST;
        $args = array(
            'registration_number' => FILTER_SANITIZE_SPECIAL_CHARS,
            'photo' => FILTER_SANITIZE_SPECIAL_CHARS,
            'availability' => FILTER_SANITIZE_SPECIAL_CHARS,
        );
        $validatedData = filter_var_array($data, $args);
        extract($validatedData);
        try {
            if ($bikeModel ->create($validatedData)) {
                $_SESSION['notification']['success'] = 'Le vélo a bien été enregistré!';
                redirectToRoute('bikes.create');
                exit();
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }
    $generateRegistration = generateUniqueRegistration();
    $title = 'Ajouter un vélo';
    $this->render('bikes/create', compact('title', 'generateRegistration'));
}
}