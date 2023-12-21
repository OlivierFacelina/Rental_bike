<?php
require_once('vendor/autoload.php');
require_once('utils/functions.php');
use App\Controllers\Bikes;
use App\Controllers\Users;
use App\Controllers\Reservation;
use App\Controllers\LogOut;
// On démarre la session
session_start();

$path = $_GET["path"] ?? '';

$path = filter_var($path, FILTER_SANITIZE_URL);

$bikesController = new Bikes;
$reservationController = new Reservation;
$usersController = new Users;
$LogOut_controller = new LogOut;
// var_dump($student_controller);

$route = match ($path) {
    '', '/' => $bikesController->index(),
    'home' => $LogOut_controller->LogOut(),
    'bikes.details' => $bikesController->edit(),
    'bikes.create' => $bikesController->create(),
    'reservation.create' => $reservationController->create(),
    'users.index' => $usersController->index(),
    'reservations.index' => $reservationController->index(),
    'users.dashboard' => $usersController->all(),
    'users.edit' => $usersController->edit(),
    'users.delete' => $usersController->delete(),
    'users.details'=> $usersController-> find(),
    default => '404'
};
// users.details_none