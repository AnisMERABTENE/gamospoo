<?php

class CarController {
    public CarRepository $carRepository;

    public function __construct($dbh) {
        $this->carRepository = new CarRepository($dbh);
    }

    public function checkDate() {
        $startDate = $_GET['start_date'] ?? null;
        $endDate = $_GET['end_date'] ?? null;

        if (!$startDate || !$endDate) {
            header('Location: /home.php');
            exit;
        }

        if (strtotime($startDate) > strtotime($endDate)) { // strtoTime Transforme un texte anglais en timestamp
            $error = "La date de retour doit être postérieure à la date de départ.";
            require_once 'views/home.php';
            return;
        }

        $voituresDisponibles = $this->carRepository->trouverVoituresDispo($startDate, $endDate);
        
        require_once 'views/cars.php';
    }
}