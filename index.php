<?php

require_once('vendor/autoload.php');
require_once('utils/functions.php');
use App\Controllers\Bikes;
use App\Controllers\Users;
use App\Controllers\Reservation;
// On démarre la session
session_start();

$path = $_GET["path"] ?? '';

$path = filter_var($path, FILTER_SANITIZE_URL);

$bikesController = new Bikes;
$reservationController = new Reservation;
$usersController = new Users;

// var_dump($student_controller);

$route = match ($path) {
    '', '/' => $bikesController->index(),
    'bikes.details' => $bikesController->edit(),
    'bikes.create' => $bikesController->create(),
    'reservation.create' => $reservationController->create(),
    'users.index' => $usersController->index(),
    'users.create' => $usersController->create(),
    'bikes.create' => $bikesController->create(),
    'reservations.index' => $reservationController->index(),
    default => '404'
};