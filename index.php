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
    'users.create' => $usersController->create(),
    'student.delete' => $bikesController->delete(),
    default => '404'
};